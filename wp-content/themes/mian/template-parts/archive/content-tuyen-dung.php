<?php
query_posts(array('post_type' => 'page', 'post__in' => array(421)));
if (have_posts()) :
    the_post();
    $banner = get_field("banner");
    $banner_mobile = get_field("banner_mobile");
?>
    <div class="page-banner" style="background-image: url(<?php echo $banner['url']; ?>);">
        <div class="container">
            <h3><?php _e('[:vi]Tuyển dụng Mian[:][:en]Mian Recruitment[:]', 'mian'); ?></h3>
        </div>
    </div>
<?php
endif;
wp_reset_query();
?>
<div class="careers">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="subtitle"><?php _e("[:vi]Các vị trí cần tuyển[:][:en]Positions to be recruited[:]", "mian") ?></div>
                    <ul class="career-list">
                        <?php
                        $applyto = array();
                        $wlocation = array();

                        $args = [
                            'post_type'      => 'career',
                            'nopaging' => true
                        ];
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) :
                            $wNameLocation = array();
                            $loop->the_post();
                            $file_detail = get_field("file_detail");
                            $end_day = get_field("end_day");
                            $terms = wp_get_post_terms(get_the_ID(), "wlocation");
                            $applyto[] = get_the_title();
                            foreach ($terms as $key => $value) {
                                $cate = $value;
                                if (!in_array($cate->name, $wNameLocation)) {
                                    $wNameLocation[] = $cate->name;
                                }

                                if (!in_array($cate->name, $wlocation)) {
                                    $wlocation[] = $cate->name;
                                }
                            }


                        ?>
                            <li>
                                <div class="career-title">
                                    <?php the_title() ?>
                                </div>
                                <div class="career-location"><?php _e("Nơi làm việc", "mian") ?>: <span class="slocation"><?php echo implode(", ", $wNameLocation); ?></span></div>
                                <?php if(!empty($end_day)):?>
                                    <div class="end-day"><?php _e('[:vi]Ngày kết thúc: [:][:en]End day: [:] ','mian') ?> <?php _e($end_day); ?></div>
                                <?php endif; ?>
                                <div class="summaries">
                                    <?php the_content() ?>
                                </div>
                                <div class="career-footer">

                                    <?php
                                    single_social_sharing();
                                    if ($file_detail) : ?>
                                        <div class="downloadfile">
                                            <?php _e("Tải thông tin chi tiết", "mian") ?> <a target="_blank" href="<?php echo $file_detail['url'] ?>"><?php _e("Tại đây", "mian") ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </li>
                        <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12" id="scareer">
                <div class="subtitle"><?php _e("Nộp hồ sơ trực tuyến", "mian") ?></div>
                <form id="formContact" method="post" enctype="multipart/form-data">
                    <?php wp_nonce_field('sendcontact', 'field_csrf');  ?>
                    <input type="hidden" name="urlfile" id="urlfile" />
                    <input type="hidden" name="filetomail" id="filetomail" />

                    <div class="frow">
                        <div><input id="fullname" name="fullname" type="text" placeholder="<?php _e('Họ Tên', 'mian') ?>*" title="<?php _e('Họ Tên', 'mian') ?>" /></div>
                    </div>

                    <div class="frow">
                        <div><input id="youremail" name="youremail" type="email" placeholder="<?php _e('Email', 'mian') ?>*" title="<?php _e('Email', 'mian') ?>" /></div>
                    </div>
                    <div class="frow wposition">
                        <div class="col-left-text"><?php _e("Ứng tuyển vào vị trí", 'mian') ?></div>
                        <div class="col-right-input">
                            <select name="applyto" id="applyto">
                                <?php foreach ($applyto as $key => $value) : ?>
                                    <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="frow">
                        <div class="col-left-text"><?php _e("Nơi làm việc", 'mian') ?></div>
                        <div class="col-right-input">
                            <select name="wlocation" id="wlocation">
                                <?php foreach ($wlocation as $key => $value) : ?>
                                    <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="frow">
                        <div class="col-left-textarea"><textarea id="yourmess" name="yourmess" placeholder="<?php _e('Chú thích', 'mian') ?>" title="<?php _e('Chú thích', 'mian') ?>"></textarea></div>
                        <div class="col-right-file">
                            <div class="errorfile"></div>
                            <div class="bg-upload" onclick="initalFile()">
                                <div><img src="<?php echo get_template_directory_uri() . '/images/icon-uploadcv.png'  ?>"></div>
                                <div><?php _e("Tải lên CV của bạn", "mian") ?></div>
                            </div>
                            <div class="resultfile"></div>
                            <div class="deletefile" onclick="deleteFile()"><img width="20px" height="20px" src="<?php echo get_template_directory_uri() . '/images/icon-menu-close.png'  ?>"></div>

                            <input type="file" id="filecv" name="filecv" style="display: none;" />

                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="frowbutton">
                        <div id="sendloading"></div> <button id="btnsend" type="button" onclick="sendCareer()"><?php _e('Gửi', 'mian') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    <div class="clearfix"></div>
</div>
<script>
    $(function() {
        setActiveCareer();
        $('select').formSelect();
        $("#filecv").change(function() {
            var fileName = $(this).val();
            fileName = fileName.split(/(\\|\/)/g).pop()
            $(".resultfile").html(fileName);
            $(".bg-upload").hide();
            $(".resultfile").show();
            $(".deletefile").show();
        });
    });

    function deleteFile() {
        $("#filecv").val("");
        $(".resultfile").html("");
        $(".resultfile").hide();
        $(".deletefile").hide();
        $(".bg-upload").show();
    }

    function initalFile() {
        $("#filecv").click();
    }

    function sendCareer() {
        if ($("#fullname").val() == "") {
            $("#fullname").focus();
            return false;
        }

        if ($("#youremail").val() == "") {
            $("#youremail").focus();
            return false;
        }
        if (!isValidEmailAddress($("#youremail").val())) {
            $("#youremail").focus();
            return false;
        }
        if ($("#filecv").val() == "") {
            $(".errorfile").show();
            return false;
        }
        $(".errorfile").hide();

        /*upload fil*/
        var file_data = $('#filecv').prop('files')[0];
        var form_data = new FormData();
        form_data.append("action", "ajaxuploadfile");
        form_data.append('ibenic_file_upload', file_data);
        if (allowsend) {
            $("#sendloading").addClass('loading');
            $("#btnsend").addClass('disabled');
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: form_data,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                async: "false",
                success: function(obj) {
                    if (obj.response == "SUCCESS") {
                        $("#urlfile").val(obj.url);
                        $("#filetomail").val(obj.filetomail);

                        $.ajax({
                            url: ajaxurl,
                            type: 'post',
                            data: {
                                action: 'sendccareer',
                                data: $("#formContact").serialize()
                            },
                            success: function(result) {
                                if (result == 1) {
                                    $("#sendloading").hide();
                                    $("#btnsend").removeClass('disabled');
                                    $.fancybox.open($("#thankyou"));
                                    allowsend = true;
                                }
                            },
                            error: function(error) {
                                $("#btnsend").removeClass('disabled');
                                $("#sendloading").removeClass('loading');
                                $("#thankyou").addClass('show');
                                setTimeout(function(){ $("#thankyou").removeClass('show'); }, 3000);
                            }
                        });

                    } else {
                        $("#sendloading").hide();
                        $("#btnsend").removeClass('disabled');
                        $.fancybox.open($("#perror"));
                        allowsend = true;
                    }
                },
                error: function(error) {
                    console.log('error');
                }
            });
        }

    }

    function setCareer(applyto, wlocation) {
        $("#applyto").val(applyto);
        $('#applyto').formSelect();
        $("#wlocation").val(wlocation);
        $('#wlocation').formSelect();
        $("#fullname").focus();
    }
</script>