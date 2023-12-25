var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host;
jQuery(document).ready(function ($) {
    $('.tipMe').tooltip();
//    $('.scroll-pane').jScrollPane();
    $(window).resize(function () {
        if ($(window).width() < 1190) {
            $("#bannerwrapper").css("padding-left", "0px");
        }
    });

    // remove padding when window width is to small
    function removeBannerPadding() {
        if ($(window).width() < 1190) {
            $("#bannerwrapper").css("padding-left", "0px");
        }
    }
    removeBannerPadding();


    $(document).on('click', '#pcPhotoUploadBtn', function () {
        $('#users-image').trigger('click');
    });
    $(document).on('change', '#users-image', function (e) {
        var formData = new FormData($('#email-setting-form')[0]);
        formData.append("image", e.target.files[0]);
        $.ajax({
            url: baseUrl + '/home/user/file-upload',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if (data.success == 1) {
                    location.reload();
                } else if (data.error == 1) {
                    alert('file is not uploaded successfully');
                } else if (data.error == 2) {
                    alert('You can not upload more');
                }
            }
        });
    });
    $(document).on('click', '.photoOptions', function (e) {
        e.preventDefault();
        var photooverlayid = $(this).attr('data-photooverlayid');
        console.log(photooverlayid);
        $('#' + photooverlayid).toggle();
    });




    $(document).on('click', '#attachmentUploader', function () {
        $('#useridentityverification-image').trigger('click');
    });
    $(document).on('change', '#useridentityverification-image', function (e) {
        var formData = new FormData($('#email-verify-form')[0]);
        formData.append("image", e.target.files[0]);
        $.ajax({
            url: baseUrl + '/home/user/verify-uploaded-doc',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if (data.success == 1) {
                    window.location.href = baseUrl + '/home/user/verify-profile?success=1';
                } else if (data.error == 1) {
                    alert('file is not uploaded successfully');
                } else if (data.error == 2) {
                    alert('You can not upload more');
                }
            }
        });
    });

    $(".member").hover(
            function () {
                $(".actionicons", this).show();
                $(".name", this).hide();
                $(".location", this).hide();
            },
            function () {
                $(".actionicons", this).hide();
                $(".name", this).show();
                $(".location", this).show();
            }
    );

    $('.icons.icons-standard').on('click', function () {
        $('#member-benefits-popup').dialog({
            dialogClass: "no-close",
            modal: true,
            minHeight: 150,
        })
    });

    $('#closeModalWindow').on('click', function () {
        $('#member-benefits-popup').dialog('close');
    });

    $('#partnercupidtags-cupid_tag_name').on('keyup keypress blur change', function () {
        var val = $(this).val();
        var letters = /^[0-9a-zA-Z]+$/;
        $('#notAllowedMsg').css('display', 'none');
        $('.greenShinyButton').removeAttr('disabled');
        if (val == '') {
            $('#notAllowedMsg').css('display', 'block')
            $('#notAllowedMsg').html('Please enter any word');
            $('.greenShinyButton').prop('disabled', true);
        } else if (!val.match(letters)) {
            $('#notAllowedMsg').css('display', 'block')
            $('#notAllowedMsg').html('Please enter only letters and numbers!');
            $('.greenShinyButton').prop('disabled', true);
        }
    });


    var nInitialCount = 150; //Intial characters to display
    var moretext = "Read more >";
    var lesstext = "Read less";
    var paraText = $('.profiletextsummary p').html();
    if (paraText && paraText.length > nInitialCount) {
        var sText = paraText.substr(0, nInitialCount);
        var eText = paraText.substr(nInitialCount, paraText.length - nInitialCount);
        var newHtml = sText + '...<span class="moretext"><span>' + eText + '</span><a href="" class="links">' + moretext + '</a></span>';
        $('.profiletextsummary p').html(newHtml);
    }

    $(".profiletextsummary .links").on('click', function (e) {
        var lnkHTML = $(this).html();
        if (lnkHTML == lesstext) {
            $(this).html(moretext);
        } else {
            $(this).html(lesstext);
        }
        $(this).prev().toggle();
        e.preventDefault();
    });

    $('.profile.navmenu .navtabs li').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('.navmenu .navtabs li').removeClass('selected');
        $(this).addClass('selected');
        $('.profileright').css('display', 'none');
        $('#' + id).css('display', 'block');
    });

    $('.enlargeThumb').click(function (e) {
        var photourl = $(this).attr('href');
        var photono = $(this).attr('name');
        e.preventDefault();
        enlargePhoto(photourl, photono);
    });
    $('#photoComment').on('click',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var options = {
            modal: true,
            height:600,
            width:900
        };
        $('#ajax-modal-profile').load(baseUrl+'/home/user/ajax-view-profile?id='+id).dialog(options).dialog('open');
    })
    
    $('.photo-display-popup').on('click',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var options = {
            modal: true,
            height:600,
            width:900
        };
        $('#ajax-modal-profile').load(baseUrl+'/home/user/ajax-view-profile?id='+id).dialog(options).dialog('open');
    })
    
        // Get photo count
    var photo_count = $(".small-photo").length;
    // Activate paginator and selector when more than 1 photo
    if (photo_count && photo_count > 1)
    {
        // Paginate prev/next
        $('div#pagination').click(function(e) {
            if ($(e.target).hasClass('next'))
                next();
            else
                prev();
        });
    }
    else
    {
        // Only 1 photo remove select and paginate ability
        $('#photo-container .paginator').hide();
        $('#photo-container .selected').removeClass('selected').addClass('deselected nocursor');
    }
    
    $('#interest-btn').on('click',function(e){
       e.preventDefault();
       var href = $(this).attr('href');
       $.ajax({
            url: baseUrl + href,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.success == 1) {
//                    $('#interest-btn img').attr('src','');
                    $('#interest-btn img').attr('src','/images/btn-interest-select.gif');
                } else if (data.error == 1) {
                    alert('something went wrong');
                }
            }
        });
    });
    
    $('.iconinterest.sendinterest').on('click',function(e){
       e.preventDefault();
       var href = $(this).find('a').attr('href');
       $.ajax({
            url: baseUrl + href,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.success == 1) {
                    $('.iconinterest.sendinterest').removeClass('sendinterest').addClass('iconinterestsent');
                } else if (data.error == 1) {
                    alert('something went wrong');
                }
            }
        });
    });
    
    $('.iconfavorites.addfavorites').on('click',function(e){
       e.preventDefault();
       var href = $(this).find('a').attr('href');
       $.ajax({
            url: baseUrl + href,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.success == 1) {
                    $('.iconfavorites.addfavorites').removeClass('addfavorites').addClass('iconfavoritessent');
                } else if (data.error == 1) {
                    alert('something went wrong');
                }
            }
        });
    });
    
    $('#favorites-btn-email').on('click',function(e){
       e.preventDefault();
       var href = $(this).attr('href');
       $.ajax({
            url: baseUrl + href,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.success == 1 && data.exist == 0) {
                    $('#favorites-btn-email img').attr('src','/images/btn-favorites-select.gif');
                } else if (data.success == 1 && data.exist == 1) {
                    $('#favorites-btn-email img').attr('src','/images/btn-favorites-up.gif');
                }else {
                    alert('something went wrong');
                }
            }
        });
    });
    
    $('#blockuser-btn-email').on('click',function(e){
       e.preventDefault();
       var href = $(this).attr('href');
       $.ajax({
            url: baseUrl + href,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.success == 1 && data.exist == 0) {
                    $('#blockuser-btn-email img').attr('src','/images/btn-blockuser-select.gif');
                } else if (data.success == 1 && data.exist == 1) {
                    $('#blockuser-btn-email img').attr('src','/images/btn-blockuser-up.gif');
                }else {
                    alert('something went wrong');
                }
            }
        });
    });
    
    
    $('#report-btn').on('click',function(e){
       e.preventDefault();
       var href = $(this).attr('href');
        var options = {
            modal: true,
            height:500,
            width:600
        };
        $('#ajax-modal-profile').load(baseUrl+href).dialog(options).dialog('open');
    });

    $('.emailpopup').on('click',function(e){
       e.preventDefault();
       var href = $(this).attr('href');
        var options = {
            modal: true,
            height:700,
            width:630
        };
        $('#ajax-modal-profile').load(baseUrl+href).dialog(options).dialog('open');
    });
//    $('.sent-sm.scroll-pane').jScrollPane();

    $('.submitbtn #sendReplyBtn').on('click',function(e){
       e.preventDefault();
       var form = $('#emailreplyform');
       $(this).val('Sending...');
       $.ajax({
            url: form.attr('action'),
            data:form.serialize(),
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('.submitbtn #sendReplyBtn').val('Send Message');
                if(data.success==1) {
                    $('.sent-sm.scroll-pane').append(data.html);
                    $('div#sent').animate({
                        scrollTop: $('div#sent')[0].scrollHeight}, "slow");
                }else {
                    if(data.message) {
                        alert(data.message);
                    }
                }
            }
        });
    });
    
    $('#sendEmailBtnhome').on('click',function(e){
       e.preventDefault();
       var form = $('#emailreplyform');
       $(this).val('Sending...');
       $.ajax({
            url: form.attr('action'),
            data:form.serialize(),
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#sendEmailBtnhome').val('Send Message');
                if(data.success==1) {
                    $('#comments-panel #heading').html('');
                    $('#comments-panel #heading').html(data.html);
                }else {
                    alert('something went wrong');
                }
            }
        });
    });

    var replyView = $('.replyview');
    if(replyView.is(':visible')) {
        $('div#sent').animate({
                        scrollTop: $('div#sent')[0].scrollHeight}, "slow");
    }

        setInterval(function(){ 
            receivedMessage();
            var replyView = $('.replyview');
            if(replyView.is(':visible')) {
                $('div#sent').animate({
                                scrollTop: $('div#sent')[0].scrollHeight}, "slow");
            }
        }, 5000);
    

});

var isMessageAppend = false;

function receivedMessage() {
    var form = $('#emailreplyform');
    $.ajax({
        url: baseUrl+'/home/messages/received',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if(data.success==1) {
                var replyView = $('.replyview');
                if(replyView.is(':visible') && isMessageAppend == false) {
                    $('.sent-sm.scroll-pane').append(data.html);
                    updateMessageStatus();
                }
                $('.mynotificationCircle.circle').html(data.total);
                $('.messages.unread').html(data.total);
            }else if(data.status == 0) {
                $('.mynotificationCircle.circle').html(data.total);
                $('.messages.unread').html(data.total);
            }
        }
    });
}

function updateMessageStatus() {
    $.ajax({
        url: baseUrl+'/home/messages/status-update',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if(data.success==1) {
                isMessageAppend = false;
                $('.mynotificationCircle.circle').html(data.total);
                $('.messages.unread').html(data.total);
            }
        }
    });
}

function enlargePhoto(photourl, photono) {
    var $pic = $('#pic')


    if ($("#videoDisplay").length) {
        $("#videoDisplay").html('') // if there was video / message before then clear it.
    }

    $($pic).css('background-image', ''); // remove member photo to display load icon (set in css) sitting behind.

    if ($("#photoEnlargeAddPhoto").length && photono != 1) {

        $("#photoEnlargeAddPhoto").show();

    } else {

        if ($("#photoEnlargeAddPhoto").length) {
            $("#photoEnlargeAddPhoto").hide();
        }

        var tmpImg = new Image();
        tmpImg.src = photourl;
        tmpImg.onload = function () {
            $($pic).css('background-image', 'url(' + photourl + ')')
        };
        tmpImg.src = photourl;

    }
}
// namespaced functions

// Next function
function next() {
    // Next photo exist
    if ($('.selected').next('li').length > 0)
    {
        // Get next element
        $('.selected').removeClass('selected').addClass('deselected').next().addClass('selected').removeClass('deselected');
    }
    // No next photo
    else
    {
        // Remove selected from current
        $('.selected').removeClass('selected').addClass('deselected');
        // Go to first photo
        $('.small-photo').first().addClass('selected').removeClass('deselected');
    }
    // Load selected big photo
    var image_src = $('.selected').attr('data-big-photo');
    var photo_num = $('.selected').attr('data-photo-number');
    var profile_grade = $('#addcomment').attr('data-profileGrade');
    var member_grade = $('#addcomment').attr('data-memberGrade');
    var showMessage = $('#addcomment').attr('data-showMessage');
    loadImage(image_src,photo_num,profile_grade,member_grade,showMessage);
}
// Prev function
function prev() {
    // Prev photo exist
    if ($('.selected').prev('li').length > 0)
    {
        // Get next element
        $('.selected').removeClass('selected').addClass('deselected').prev().addClass('selected').removeClass('deselected');
    }
    // No prev photo
    else
    {
        // Remove selected from current
        $('.selected').removeClass('selected').addClass('deselected');
        // Go to first photo
        $('.small-photo').last().addClass('selected').removeClass('deselected');
    }
    // Load selected big photo
    var image_src = $('.selected').attr('data-big-photo');
    var photo_num = $('.selected').attr('data-photo-number');
    var profile_grade = $('#addcomment').attr('data-profileGrade');
    var member_grade = $('#addcomment').attr('data-memberGrade');
    var showMessage = $('#addcomment').attr('data-showMessage');
    loadImage(image_src,photo_num,profile_grade,member_grade,showMessage);
}

function loadImage(src,photoid,profile_grade,member_grade,showMessage) {

    $('.loading-icon').show();
    $('.paginator').hide();
    $('.big-photo-selected').hide();
    var i = $("<img />").attr('src',src).load(function() {
        $('.big-photo-selected').attr('src', i.attr('src')).attr('data-photoid', photoid);
        $('.loading-icon').hide();
        $('.big-photo-selected').show();
        $('.paginator').show();
        // Add comment form
        if (showMessage == 2)
        {
            $('#standard-message').hide();
            $('#comments-panel').fadeIn(500);
        }
        else
            $('#paying-message').slideUp();
    });

}