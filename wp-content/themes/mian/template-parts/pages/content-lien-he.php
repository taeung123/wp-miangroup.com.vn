<?php 
    if(have_posts()):
        $banner = get_field("banner");
        $banner_mobile = get_field("banner_mobile");
        $van_phong = get_field("van_phong");
?>
<div class="page-banner">
    <img src="<?php echo $banner['url'] ?>" data-bmobile="<?php echo $banner_mobile['url'] ?>" id="banner_mobile"/>
</div>
<div class='contact'>
    <div class="term-describe"><?php the_content() ?></div>
    <div class="contact-form">
        <div class="contact-left">
            <div class="subtitle"><?php _e("Văn phòng của chúng tôi", "mian") ?></div>
            <ul class="tag-vanphong">
                <?php foreach ($van_phong as $key => $value) : ?>
                    <li onclick="switchOffice(<?php echo $key ?>)" <?php if($key == 0): ?> class="active" <?php endif; ?>><?php echo $value['name_vp']  ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="clearfix"></div>
            <?php foreach ($van_phong as $key => $value) : ?>
                <div class="contentvp<?php echo $key ?> contentvp <?php if($key == 0): ?> active <?php endif; ?>"><?php echo $value['content_vp']  ?></div>
            <?php endforeach; ?>
        </div>
        
        <div class="contact-right">
            <div class="subtitle"><?php _e("Gửi tin nhắn cho chúng tôi", "mian") ?></div>
            <form id="formContact">
                <?php wp_nonce_field('sendcontact','field_csrf');  ?>
                    <div class="frow">
                        <input id="firstname" name="firstname" type="text" placeholder="<?php _e('Họ', 'mian') ?>*" title="<?php _e('Họ', 'mian') ?>" />
                    </div>
                    <div class="frow">
                        <input id="lastname" name="lastname" type="text" placeholder="<?php _e('Tên', 'mian') ?>*" title="<?php _e('Tên', 'mian') ?>" />
                    </div>
                    <div class="frow">
                        <input id="youremail" name="youremail" type="email" placeholder="<?php _e('Email', 'mian') ?>*" title="<?php _e('Email', 'mian') ?>" />
                    </div>
                    <div class="frow">
                        <input id="phonenumber" name="phonenumber" type="text" placeholder="<?php _e('Điện thoại', 'mian') ?>*" title="<?php _e('Điện thoại', 'mian') ?>" />
                    </div>
                    <div class="frow">
                        <input id="company" name="company" type="text" placeholder="<?php _e('Công ty', 'mian') ?>*" title="<?php _e('Công ty', 'mian') ?>" />
                    </div>
                    <div class="frow">
                        <textarea name="yourmess" placeholder="<?php _e('Thông điệp', 'mian') ?>"></textarea>
                    </div>
                    
                    <div class="frowbutton"> <div id="sendloading" class="sendloading"></div> <button id="btnsend"  type="button" onclick="sendContact()"><?php _e('Gửi', 'mian') ?></button></div>
                    
                    
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php endif; ?>