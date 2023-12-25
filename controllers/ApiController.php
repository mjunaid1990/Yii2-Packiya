<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\PaperMeterial;
use app\models\Products;
use app\models\BoxDetails;
use app\models\Faqs;
use app\models\Reviews;
use app\models\Inquiries;
use app\models\Settings;
use app\models\Pages;
use app\models\Quantities;
use app\models\ProductImages;
use app\models\Quotes;
use app\models\ProductMainCategories;
use app\models\ProductChildCategories;
use yii\data\Pagination;

class ApiController extends Controller {
    /**
     * Displays homepage.
     *
     * @return string
     */

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
//        if ($action->id == 'm') {
//            $this->enableCsrfValidation = false;
//        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionHome() {
        $products = Products::find()->where(['IN', 'id', [1, 2, 3]])->all();
        $data = [];
        if ($products) {
            foreach ($products as $k => $product) {
                $data['custom'][$k] = $product->attributes;
                $data['custom'][$k]['description'] = strip_tags($product->description);

                $gallery = ProductImages::find()->where(['product_id' => $product->id])->orderBy(['order_no' => SORT_ASC])->one();
                if ($gallery && $gallery->image) {
                    $data['custom'][$k]['description_image_url'] = Yii::$app->request->baseUrl . '/uploads/products/gallery/' . $gallery->id . '/' . $gallery->image;
                } else {
                    if ($product->description_image) {
                        $data['custom'][$k]['description_image_url'] = $product->getImageurl('description_image');
                    }
                }

                if ($product->overview_image) {
                    $data['custom'][$k]['overview_image_url'] = $product->getImageurl('overview_image');
                }
            }
        }
        $top_selling = Settings::find()->where(['option_name' => 'top_selling_product_ids'])->one();
        if ($top_selling) {
            $top_selling->option_value = explode(',', $top_selling->option_value);
        }
        $products = Products::find()->where(['IN', 'id', $top_selling->option_value])->all();
        if ($products) {
            foreach ($products as $k => $product) {
                $data['selling'][$k] = $product->attributes;
                $data['selling'][$k]['description'] = strip_tags($product->description);

                $gallery = ProductImages::find()->where(['product_id' => $product->id])->orderBy(['order_no' => SORT_ASC])->one();
                if ($gallery && $gallery->image) {
                    $data['selling'][$k]['description_image_url'] = Yii::$app->request->baseUrl . '/uploads/products/gallery/' . $gallery->id . '/' . $gallery->image;
                } else {
                    if ($product->description_image) {
                        $data['selling'][$k]['description_image_url'] = $product->getImageurl('description_image');
                    }
                }

                if ($product->overview_image) {
                    $data['selling'][$k]['overview_image_url'] = $product->getImageurl('overview_image');
                }
            }
        }
        $data['faqs'] = Faqs::find()->where(['box_id' => null])->asArray()->all();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['status' => 'success', 'data' => $data];
    }

    public function actionPage($slug) {
        $page = Pages::find()->where(['slug' => $slug])->one();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['status' => 'success', 'data' => $page];
    }

    public function actionMaterialByBox($id) {
        $material = PaperMeterial::find()->where(['box_type' => $id])->all();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['status' => 'success', 'data' => $material];
    }

    public function actionProductBySlug($slug) {
        $product = Products::find()->where(['slug' => $slug])->one();
        $data = null;
        if ($product) {
            $data = $product->attributes;
//            $data['overview'] = str_replace("&nbsp;", ' ', $product->overview);
//            $data['description'] = str_replace("&nbsp;", ' ', $product->description);
            if ($product->description_image) {
                $data['description_image_url'] = $product->getImageurl('description_image');
            }
            if ($product->overview_image) {
                $data['overview_image_url'] = $product->getImageurl('overview_image');
            }
            $data['images'] = $product->getGallery();
            $data['faqs'] = Faqs::find()->where(['box_id' => $product->box_type])->asArray()->all();
            $data['reviews'] = Reviews::find()->asArray()->all();
            $data['quantities'] = Quantities::find()->where(['box_id' => $product->box_type])->orderBy(['option_name' => SORT_ASC])->asArray()->all();
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['status' => 'success', 'data' => $data];
    }

    public function actionCalculateRate() {


        $data = [];
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($this->request->isPost) {

            $p_data = file_get_contents("php://input");
            $post = json_decode($p_data, true);

            if ($post['box_type']) {
                if ($post['box_type'] == 1) {
                    if ($post['box_sub_type'] == 'corrugated') {
                        $model = BoxDetails::find()->where(['box_type' => $post['box_type'], 'box_sub_type' => 2, 'box_paper_size' => $post['box_paper_size']])->one();
                    } else if ($post['box_sub_type'] == 'cardstock') {
                        $model = BoxDetails::find()->where(['box_type' => $post['box_type'], 'box_sub_type' => 1, 'box_paper_size' => $post['box_paper_size']])->one();
                    }
                } else {
                    $model = BoxDetails::find()->where(['box_type' => $post['box_type']])->one();
                }

                if ($model) {
                    $rs = $this->Calculate($model, $post);
                    if ($rs) {
                        $qt = [];
                        $data['rate'] = $rs['price'];
                        $data['weight'] = $rs['weight'];
                        if (isset($post['quantity']) && $post['quantity'] != 'sample') {
                            if ($rs['price_wd']) {
                                if ($post['box_type'] == 1) { //product
                                    if ($model->box_sub_type == 1) {
                                        $quantites = Quantities::find()->where(['box_id' => $post['box_type'], 'box_sub_type' => 1])->asArray()->all();
                                    } else if ($model->box_sub_type == 2) {
                                        $quantites = Quantities::find()->where(['box_id' => $post['box_type'], 'box_sub_type' => 2])->asArray()->all();
                                    }
                                } else if ($post['box_type'] == 2) { // mailer
                                    $quantites = Quantities::find()->where(['box_id' => $post['box_type']])->asArray()->all();
                                } else if ($post['box_type'] == 3) { // shipping
                                    $quantites = Quantities::find()->where(['box_id' => $post['box_type']])->asArray()->all();
                                }
                            }

                            if (isset($quantites)) {
                                foreach ($quantites as $k => $qtys) {
                                    $qt[$k] = $qtys;
                                    $discount = ( $qtys['option_discount'] / 100 ) * floatval($rs['price_wd']);
                                    $each = floatval($rs['price_wd']) - $discount;
                                    $qt[$k]['each_price'] = number_format($each, 2);
                                }
                            }
                            $data['quantities'] = $qt;
                        }
                    } else {
                        $data['rate'] = 'N/A';
                    }
                }
            }
        }

        return ['status' => 'success', 'data' => $data];
    }

    public function actionCheckout() {
        $post = json_decode(file_get_contents("php://input"), true);
        $model = new Inquiries();
        $data['success'] = false;
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($post) {

            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys


            $charge = $stripe->paymentIntents->create([
                'amount' => $post['amount'] * 100,
                'currency' => 'USD',
                'description' => $post['order_info']['box_detail']['product_name'],
                'payment_method' => $post['id'],
                'confirm' => true,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never'
                ]
            ]);

            unset($post['id']);

            if ($charge->client_secret) {
                $model->payment_id = $charge->id;
                $model->currency = 'USD';
                $model->total_amount = $post['amount'];
                $model->order_info = json_encode($post['order_info']);
                $model->shipping_info = json_encode($post['shipping_info']);
                $model->shipping_method = $post['shipping_method'];
                $model->email = $post['shipping_info']['email'];
                if ($model->save()) {

                    

                    $data['success'] = true;
                }
                return $data;
            }
        }
        return $data;
    }

    public function actionQuote() {
        $post = json_decode(file_get_contents("php://input"), true);
        $model = new Quotes();
        $data['success'] = false;
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($post) {
            $model->attributes = $post;
            if ($model->save()) {
                $data['success'] = true;
            }
        }
        return $data;
    }
    
    
    
    public function actionCategoriesList($slug = '') {
//        $p_data = file_get_contents("php://input");
//        $post = json_decode($p_data, true);
        $q = Yii::$app->request->get('q');
        
        if($slug && $slug != 'undefined') {
            $category = ProductChildCategories::find()->where(['slug'=>$slug])->one();
            if($category) {
                $data['category'] = $category->attributes;
                $query = Products::find()->where(['child_category_id'=>$category->id]);
                if($q) {
                    $query->where(['like', 'name', '%'.$q.'%']);
                }
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize'=>9]);
                $data['pageCount'] = $pages->pageCount;
                $products = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
                if($products) {
                    foreach ($products as $k=>$product) {
                        $data['products'][$k] = $product->attributes;
                        $data['products'][$k]['description'] = strip_tags($product->description);

                        $gallery = ProductImages::find()->where(['product_id' => $product->id])->orderBy(['order_no' => SORT_ASC])->one();
                        if ($gallery && $gallery->image) {
                            $data['products'][$k]['description_image_url'] = Yii::$app->request->baseUrl . '/uploads/products/gallery/' . $gallery->id . '/' . $gallery->image;
                        } else {
                            if ($product->description_image) {
                                $data['products'][$k]['description_image_url'] = $product->getImageurl('description_image');
                            }
                        }

                        if ($product->overview_image) {
                            $data['products'][$k]['overview_image_url'] = $product->getImageurl('overview_image');
                        }
                    }
                }
            }
        }else {
            $query = Products::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize'=>9]);
            $data['pageCount'] = $pages->pageCount;
            $products = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
            if($products) {
                foreach ($products as $k=>$product) {
                    $data['products'][$k] = $product->attributes;
                    $data['products'][$k]['description'] = strip_tags($product->description);

                    $gallery = ProductImages::find()->where(['product_id' => $product->id])->orderBy(['order_no' => SORT_ASC])->one();
                    if ($gallery && $gallery->image) {
                        $data['products'][$k]['description_image_url'] = Yii::$app->request->baseUrl . '/uploads/products/gallery/' . $gallery->id . '/' . $gallery->image;
                    } else {
                        if ($product->description_image) {
                            $data['products'][$k]['description_image_url'] = $product->getImageurl('description_image');
                        }
                    }

                    if ($product->overview_image) {
                        $data['products'][$k]['overview_image_url'] = $product->getImageurl('overview_image');
                    }
                }
            }
        }
        $categories = [];
        $main_cats = ProductMainCategories::find()->all();
        if($main_cats) {
            foreach ($main_cats as $cat) {
                $categories[] = [
                    'name'=>$cat->name,
                    'id'=>$cat->id,
                    'items'=>ProductChildCategories::find()->where(['product_main_cat_id'=>$cat->id])->all()
                ];
            }
        }
        $data['categories'] = $categories;
        $data['faqs'] = Faqs::find()->where(['box_id' => 1])->asArray()->all();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['status' => 'success', 'data' => $data];
    }

    protected function Calculate($model, $post) {
        $length = floatval($post['box_length']);
        $width = floatval($post['box_width']);
        $height = floatval($post['box_depth']);

        $paper_sheet_size = $model->box_width * $model->box_height;

        $paper_gsm = $model->paper_gsm ? $model->paper_gsm : 300;

        if ($model->box_sub_type == 2) {
            $paper_weight = ( $paper_sheet_size * (int) $paper_gsm ) / 3100;
            $paper_weight_gsm = ( $paper_weight * 1000 ) / 500;
        } else {
            $paper_weight = ( $paper_sheet_size * (int) $paper_gsm ) / 15500;
            $paper_weight_gsm = ( $paper_weight * 1000 ) / 100;
        }

        $per_paper_price = $model->per_paper_price ? $model->per_paper_price : 2.35;

        $paper_price_100_pcs = $paper_weight_gsm * $per_paper_price;

        $paper_price_one_pcs = $paper_price_100_pcs / 100;
        if ($model->box_type == 1) { //product box
            $total_width = ( $length + $width ) * 2 + 0.75;
            $total_height = $height + ( $width * 2 ) + 1.65;
        } else if ($model->box_type == 2) { // mailer box
            $total_width = ( 4 * $height ) + $length + 2;
            $total_height = ( 3 * $height ) + 2 * $width + 0.90625;
        } else if ($model->box_type == 3) { //shipping box
            $total_width = ( $length + $width ) * 2 + 2.25;
            $total_height = ( $width + $height ) + 0.625;
        }

        $total_area = $total_width * $total_height; // area of box from length, width and depth

        if ($model->box_type == 2) {
            if ($total_area > 1200) {
                $total_width = ( 4 * $height ) + $length + 3.125;
                $total_height = ( 3 * $height ) + 2 * $width + 1.1875;
            }
        } else if ($model->box_type == 3) {
            if ($total_area > 600) {
                $total_width = ( $length + $width ) * 2 + 2.5;
                $total_height = ( $width + $height ) + 0.75;
            }
        } else {
            if ($paper_sheet_size < $total_area) {
                return false;
            }
        }


        $boxes_from_one_paper_sheet = $paper_sheet_size * $total_area; // box from 1 full sheet
        //it will calculate how many boxes will be generated from above mentioned length and width
        $boxes_from_total_area = ($paper_sheet_size) / $total_area;

        $total_sheet_area = $paper_sheet_size; // this is total area of sheet that will be used in paper sheet size
        if (isset($post['quantity']) && $post['quantity'] == 'sample') {
            $sample_price = Settings::find()->where(['box_id' => $post['box_type']])->one();
            if ($sample_price) {
                if (isset($post['rush_production']) && $post['rush_production'] && $post['rush_production'] == 'rush') {
                    return ['price' => $sample_price->option_value + 25, 'weight' => null];
                } else {
                    return ['price' => $sample_price->option_value, 'weight' => null];
                }
            }
        }
        //total required area for 100 boxes
        $quantity = $post['quantity'] ? (int) $post['quantity'] : 100;

        $required_area_for_100_boxes = $total_area * $quantity;
        //total sheets required to make 100 boxes
        $required_sheets_for_100_pcs_area = $required_area_for_100_boxes / $total_sheet_area;

        $waste_sheets = $model->waste_sheets;

        // this is total sheets used with above widht, height and length
        $total_sheets = $waste_sheets + $required_sheets_for_100_pcs_area;

        // total sheets price which will be used with above width, height and length
        $used_sheets_price = $total_sheets * $paper_price_one_pcs;

        //extra material
        $packing = $total_sheets * $model->packing_rate;
        $plate = $total_sheets * $model->plating_rate;
        $die_cutting = $total_sheets * $model->die_cutting_rate;
        $side_pasting = $total_sheets * $model->side_pasting_rate;

        //100 boxes total price
        $total_price_of_100_boxes = $used_sheets_price + $packing + $plate + $die_cutting + $side_pasting;
//        echo $total_price_of_100_boxes;die();
        //check paper size
        if (isset($post['box_paper_size']) && !empty($post['box_paper_size'])) {
            $paperMaterialModel = PaperMeterial::findOne((int) $post['box_paper_size']);
            if ($paperMaterialModel) {
                $total_price_of_100_boxes = ($total_sheets * $paperMaterialModel->rate) + $total_price_of_100_boxes;
            }
        }

        //check material coating
        if (isset($post['coating']) && !empty($post['coating'])) {
            if ($post['coating'] == 'glossy_aqueous_coating') {
                $total_price_of_100_boxes = ( $total_sheets * $model->glossy_aqueous_coating) + $total_price_of_100_boxes;
            } else if ($post['coating'] == 'high_gloss_aqueous_coating') {
                $total_price_of_100_boxes = ( $total_sheets * $model->high_gloss_aqueous_coating) + $total_price_of_100_boxes;
            } else if ($post['coating'] == 'matte_aqueous_coating') {
                $total_price_of_100_boxes = ( $total_sheets * $model->matte_aqueous_coating) + $total_price_of_100_boxes;
            } else if ($post['coating'] == 'soft_touch_laminate') {
                $total_price_of_100_boxes = ( $total_sheets * $model->soft_touch_laminate) + $total_price_of_100_boxes;
            }
        }
        //check printing sides
        if (isset($post['printed_sides']) && !empty($post['printed_sides'])) {
            if ($post['printed_sides'] == 'outside_printing') {
                $total_price_of_100_boxes = ( $total_sheets * $model->outside_printing) + $total_price_of_100_boxes;
            } else if ($post['printed_sides'] == 'inside_priting') {
                $total_price_of_100_boxes = ( $total_sheets * $model->inside_priting) + $total_price_of_100_boxes;
            } else if ($post['printed_sides'] == 'both_side_printing') {
                $total_price_of_100_boxes = ( $total_sheets * $model->both_side_printing) + $total_price_of_100_boxes;
            } else if ($post['printed_sides'] == 'no_printing') {
                $total_price_of_100_boxes = ( $total_sheets * $model->no_printing) + $total_price_of_100_boxes;
            }
        }

        // check if rush production
        if (isset($post['rush_production']) && $post['rush_production'] && $post['rush_production'] == 'rush') {
            $rush = $total_price_of_100_boxes * 0.6;
        }

        if (isset($rush)) {
            $total_price_of_100_boxes = $total_price_of_100_boxes + $rush;
        }
        $weight = $required_sheets_for_100_pcs_area * 300 / 1000;
        $weight_list = [];
        if (isset($post['box_type'])) {
            if ($post['box_type'] == 1) {
                $four_day_transit = 35 + (1 * $weight);
                $weight_list[0] = round($four_day_transit, 2); // 4 day transit
                $two_day_transit = floatval($four_day_transit) * 2.2;
                $weight_list[1] = round($two_day_transit, 2); // 2 day transit
                $one_day_transit = floatval($two_day_transit) * 1.7;
                $weight_list[2] = round($one_day_transit, 2); // 1 day transit
            } else if ($post['box_type'] == 2) {
                $four_day_transit = 35 + (1 * $weight);
                $weight_list[0] = round($four_day_transit, 2); // 4 day transit
                $two_day_transit = floatval($four_day_transit) * 2.2;
                $weight_list[1] = round($two_day_transit, 2); // 2 day transit
                $one_day_transit = floatval($two_day_transit) * 1.7;
                $weight_list[2] = round($one_day_transit, 2); // 1 day transit
            } else if ($post['box_type'] == 3) {
                $four_day_transit = 35 + (1 * $weight);
                $weight_list[0] = round($four_day_transit, 2); // 4 day transit
                $two_day_transit = floatval($four_day_transit) * 2.2;
                $weight_list[1] = round($two_day_transit, 2); // 2 day transit
                $one_day_transit = floatval($two_day_transit) * 1.7;
                $weight_list[2] = round($one_day_transit, 2); // 1 day transit
            }
        }

        // 1 box price
        $total_price_of_1_box = $total_price_of_100_boxes / $quantity;
        $total_price_of_1_box_without_discount = $total_price_of_1_box;
        //calculate percentage based on quantity

        if (isset($post['box_type']) && (int) $quantity > 100) {
            if ($post['box_type'] == 1) { //product
                if ($model->box_sub_type == 1) {
                    $discount_percentage = Quantities::find()->where(['option_name' => $quantity, 'box_id' => $post['box_type'], 'box_sub_type' => 1])->one();
                } else if ($model->box_sub_type == 2) {
                    $discount_percentage = Quantities::find()->where(['option_name' => $quantity, 'box_id' => $post['box_type'], 'box_sub_type' => 2])->one();
                }
            } else if ($post['box_type'] == 2) { // mailer
                $discount_percentage = Quantities::find()->where(['option_name' => $quantity, 'box_id' => $post['box_type']])->one();
            } else if ($post['box_type'] == 3) { // shipping
                $discount_percentage = Quantities::find()->where(['option_name' => $quantity, 'box_id' => $post['box_type']])->one();
            }
        }
        if (isset($discount_percentage) && !empty($discount_percentage)) {

            if ($discount_percentage->option_discount) {
                $percent = ($discount_percentage->option_discount / 100) * $total_price_of_1_box;
                $total_price_of_1_box = floatval($total_price_of_1_box) - floatval($percent);
            }
        }

        if ($total_price_of_1_box > 0) {
            return ['price' => number_format($total_price_of_1_box, 2), 'weight' => $weight_list, 'price_wd' => $total_price_of_1_box_without_discount];
        }
        return false;
    }

}
