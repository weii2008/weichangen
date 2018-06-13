<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data

/*	$test_select_array = array(
		'no' => 'Hide',
		'yes' =>'Display',

	);*/
	
	$test_banner_array = array(
		'1' =>'1',
		'2' =>'2',
		'3' =>'3',
		'4' =>'4',

	);
	// Multicheck Defaults
/*	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);*/

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();
	///分割线////////////////////////
	$options[] = array(
		'name' =>  '基本设置',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '常规设置',
		'desc' => '站点基本功能设置',
		'type' => 'info'
	);
	$options[] = array(
		'name' => '首页文章数量',
		'desc' =>  '输入首页显示的文章数量' ,
		'id' => 'inews_t_homepagepnum',
		'std' => '20',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '是否开启文章图片水印',
		'desc' => '勾选则显示',
		'id' => 'inews_t_img_select',
		'std' => '1',
		'type' => 'checkbox',

	);
	


	$options[] = array(
		'name' => '是否显示评论框的贴图，贴视频、添加表情的功能菜单',
		'desc' => '勾选则显示',
		'id' => 'inews_t_smiley',
		'std' => '1',
		'type' => 'checkbox',
	);
	
	$options[] = array(
		'name' => '导航栏ajax菜单',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ajax_menu',
		'std' => '1',
		'type' => 'checkbox',

	);
	$options[] = array(
		'name' => '维护设置',
		'desc' => '站点进入临时维护的设置选项',
		'type' => 'info'
	);
	
	$options[] = array(
		'name' => '是否开启站点临时维护',
		'desc' => '勾选则显示，管理员不受影响',
		'id' => 'inews_t_maintain',
		'std' => '1',
		'type' => 'checkbox',
	);
	$options[] = array(
		'name' => '站点维护提示',
		'desc' => '访客将看到这段提示文字',
		'id' => 'inews_t_maintain_txt',
		'std' => '网站维护中预计开放时间:2018年1月24日 13时59分',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => '禁止多个人同时登录一个账号',
		'desc' => '勾选即可禁止',
		'id' => 'inews_t_user_has_concurrent',
		'std' => '1',
		'type' => 'checkbox',
	);
	
	///分割线////////////////////////
	$options[] = array(
		'name' => '用户设置',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '用户图标',
		'desc' => '可以禁止某些指定用户显示图标或不显示图标',
		'type' => 'info'
	);
	
	$options[] = array(
		'name' => '评论达人徽章',
		'desc' => '禁止显示评论达人徽章的用户ID，以英文逗号区分',
		'id' => 'inews_t_user_com_icon',
		'std' => '1,2,3',
		'type' => 'user_id'
	);
	
	$options[] = array(
		'name' => '禁止使用密码找回功能的用户',
		'desc' => '禁止用户ID，以英文逗号区分',
		'id' => 'inews_no_reset_id',
		'std' => '1,2,3',
		'type' => 'user_id'
	);
	
	$options[] = array(
		'name' => '官方认证图标',
		'desc' => '显示官方认证的用户ID，以英文逗号区分',
		'id' => 'inews_t_user_official_icon',
		'std' => '1,2,3',
		'type' => 'user_id'
	);
	
	$options[] = array(
		'name' => '评论等级',
		'desc' => '设置评论达人的名称以及需要的评论数量',
		'type' => 'info'
	);
	
	
	$options[] = array(
		'name' => '下载商城',
		'desc' => '设置下载商城的相关数据',
		'type' => 'info'
	);
	$options[] = array(
		'name' => '普通用户每日免费下载次数',
		'desc' => '填写具体数字',
		'id' => 'inews_t_free_downloads',
		'std' => '5',
		'type' => 'text'
	);
	$options[] = array(
		'name' => '普通用户每日额度提升5次',
		'desc' => '需要提升的用户ID，以英文逗号区分',
		'id' => 'inews_t_free_downloads_up_5',
		'std' => '1,2,3',
		'type' => 'user_id'
	);
	
	///分割线////////////////////////
	$options[] = array(
		'name' => 'SEO',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '网站描述（Description）',
		'desc' => '描述（Description）',
		'id' => 'inews_t_description',
		'std' => '描述（Description）',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => '网站关键词（KeyWords）',
		'desc' => '关键词（KeyWords）',
		'id' => 'inews_t_keywords',
		'std' => '关键词（KeyWords）',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '网站统计代码',
		'desc' => '网站统计代码',
		'id' => 'inews_t_wztjdm',
		'std' => '网站统计代码',
		'type' => 'textarea'
	);	
	
	$options[] = array(
		'name' => '是否显示网站统计',
		'desc' => '勾选为显示',
		'id' => 'inews_t_wztjdm_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);	
	
	$options[] = array(
		'name' => '备案号',
		'desc' => '输入您的备案号',
		'id' => 'inews_t_beianhao',
		'std' => '1,2,3',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '是否显示备案号',
		'desc' => '勾选为显示',
		'id' => 'inews_t_beianhao_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	///分割线////////////////////////
	$options[] = array(
		'name' => '社交媒体',
		'type' => 'heading'
	);	
	
	
	$options[] = array(
		'name' => '是否开启显示滑动图标',
		'desc' => '勾选为显示',
		'id' => 'inews_t_shehuihua_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);	
	
	
	$options[] = array(
		'name' => '新浪微博地址',
		'desc' => 'http://开头',
		'id' => 'inews_t_xinlangurl',
		'std' => 'http://',
		'type' => 'text'
	);

	$options[] = array(
		'name' => 'Facebook地址',
		'desc' => 'http://开头',
		'id' => 'inews_t_facebookurl',
		'std' => 'http://',
		'type' => 'text'
	);
	$options[] = array(
		'name' => 'Twitter地址',
		'desc' => 'http://开头',
		'id' => 'inews_t_twitterurl',
		'std' => 'http://',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => '优酷空间地址',
		'desc' => 'http://开头',
		'id' => 'inews_t_youkuurl',
		'std' => 'http://',
		'type' => 'text'
	);
	///分割线////////////////////////
	$options[] = array(
		'name' => '幻灯片广告',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '是否显示首页幻灯片广告',
		'desc' => '电脑版',
		'id' => 'inews_t_ad_banner_post',
		'std' => '1',
		'type' => 'checkbox'
	);		
	
	$options[] = array(
		'name' => '排序位置',
		'desc' => '电脑版',
		'id' => 'inews_t_ad_banner_post_order_digit',
		'std' => '1',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_banner_array
	);	
	$options[] = array(
		'name' => '是否显示首页幻灯片广告',
		'desc' => '手机版',
		'id' => 'inews_t_ad_banner_post_m',
		'std' => '1',
		'type' => 'checkbox'
	);	
	
	$options[] = array(
		'name' => '排序位置',
		'desc' => '手机版',
		'id' => 'inews_t_ad_banner_post_order_digit_m',
		'std' => '1',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_banner_array
	);
	
	$options[] = array(
		'name' => '广告内容的标题',
		'desc' => '30个字以内',
		'id' => 'inews_t_ad_banner_post_title',
		'std' => '标题',
		'type' => 'text'
	);
	$options[] = array(
		'name' => '广告图片地址',
		'desc' => '780×420像素',
		'id' => 'inews_t_banner_post_img',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => '广告打开地址',
		'desc' => 'http://',
		'id' => 'inews_t_ad_banner_post_url',
		'std' => '广告打开地址',
		'type' => 'text'
	);
	$options[] = array(
		'name' => '推广用户的ID',
		'desc' => '数字',
		'id' => 'inews_t_ad_banner_post_authorid',
		'std' => '推广用户的ID',
		'type' => 'text'
	);
	$options[] = array(
		'name' => '热度',
		'desc' => '例如：1928',
		'id' => 'inews_t_ad_banner_post_hot',
		'std' => '热度',
		'type' => 'text'
	);
	$options[] = array(
		'name' => '关键字',
		'desc' => '例如：中国，标志',
		'id' => 'inews_t_ad_banner_post_tag',
		'std' => '关键字',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => '过期时间',
		'desc' => '例如：2016-05-19 21:35:00',
		'id' => 'inews_t_ad_banner_post_time',
		'std' => '过期时间',
		'type' => 'text'
	);	
	///分割线////////////////////////
	
	
	$options[] = array(
		'name' => '特色广告',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '顶部广告',
		'desc' => '顶部广告位设置',
		'type' => 'info'
	);
	
	$options[] = array(
		'name' => '是否显示顶部640×60 Banner广告位',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_top_banner_display',
		'std' => '1',
		'type' => 'checkbox'
	);	
	
	$options[] = array(
		'name' => '顶部 640×60 Banner广告代码',
		'desc' => '468*60',
		'id' => 'inews_t_ad_top_banner_code',
		'std' => '广告代码',
		'type' => 'textarea'
	);	
	$options[] = array(
		'name' => '过期时间',
		'desc' => '例如：2016-05-19 21:35:00',
		'id' => 'inews_t_ad_top_banner_time',
		'std' => '过期时间',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => '过期后显示内容',
		'desc' => '468*60',
		'id' => 'inews_t_ad_top_banner_time_out',
		'std' => '广告代码',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => '底部广告',
		'desc' => '底部广告位设置',
		'type' => 'info'
	);

	$options[] = array(
		'name' => '是否显示文章内容底部广告',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_top_footer_display',
		'std' => '1',
		'type' => 'checkbox'
	);	
	
	$options[] = array(
		'name' => '文章内容底部广告代码',
		'desc' => '780*60',
		'id' => 'inews_t_ad_top_footer_code',
		'std' => '广告代码',
		'type' => 'textarea'
	);	
	$options[] = array(
		'name' => '过期时间',
		'desc' => '例如：2016-05-19 21:35:00',
		'id' => 'inews_t_ad_top_footer_time',
		'std' => '过期时间',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => '过期后显示内容',
		'desc' => '780*60',
		'id' => 'inews_t_ad_top_footer_time_out',
		'std' => '广告代码',
		'type' => 'textarea'
	);
	///分割线////////////////////////
	$options[] = array(
		'name' => '其他广告',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '是否显示文章页底部喜欢文章广告位',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_single_display',
		'std' => '1',
		'type' => 'checkbox'
	);	
	
	$options[] = array(
		'name' => '输入文章页底部喜欢文章广告位代码',
		'desc' => '310×120',
		'id' => 'inews_t_ad_single',
		'std' => '广告代码',
		'type' => 'textarea'
	);	
	
	$options[] = array(
		'name' => '是否显示文章页跟随浏览器二维码广告',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_ggzn_display',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '输入文章页跟随浏览器二维码广告',
		'desc' => '310×120',
		'id' => 'inews_t_ad_ggzn',
		'std' => '广告代码',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '!!!!!!是否首页文章插页780*60广告A',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_home_a_display',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '输入首页文章插页780*60广告A',
		'desc' => '780*60',
		'id' => 'inews_t_ad_home_a',
		'std' => '广告代码',
		'type' => 'textarea'
	);
	
	
	$options[] = array(
		'name' => '是否首页文章插页780*60广告B',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_home_b_display',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '输入首页文章插页780*60广告B',
		'desc' => '780*60',
		'id' => 'inews_t_ad_home_b',
		'std' => '广告代码',
		'type' => 'textarea'
	);	
	
	$options[] = array(
		'name' => '是否首页文章插页780*60广告C',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_home_c_display',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '输入首页文章插页780*60广告C',
		'desc' => '780*60',
		'id' => 'inews_t_ad_home_c',
		'std' => '广告代码',
		'type' => 'textarea'
	);
	
	
	$options[] = array(
		'name' => '是否首页文章插页780*60广告D',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_home_d_display',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '输入首页文章插页780*60广告D',
		'desc' => '780*60',
		'id' => 'inews_t_ad_home_d',
		'std' => '广告代码',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => '是否显示没有评论的时候出现的广告',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_nocomments_display',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '输入没有评论的时候出现的广告代码',
		'desc' => '宽小于640像素',
		'id' => 'inews_t_ad_nocomments',
		'std' => '广告代码',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => '输入首页浮动跟随广告位广告代码',
		'desc' => '宽小于320x80像素',
		'id' => 'inews_t_ad_widget_fixed',
		'std' => '广告代码',
		'type' => 'textarea'
	);
	$options[] = array(
		'name' => '首页浮动跟随广告位广告过期时间',
		'desc' => '例如：2016-05-19 21:35:00',
		'id' => 'inews_t_ad_widget_fixed_time',
		'std' => '过期时间',
		'type' => 'text'
	);
	///分割线////////////////////////
	
	$options[] = array(
		'name' => '手机主题设置',
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => '是否开启页面顶部主题背景图',
		'desc' => '勾选则显示',
		'id' => 'inews_t_ad_header_opne_m',
		'std' => '1',
		'type' => 'checkbox'
	);
	
	$options[] = array(
		'name' => '页面顶部主题背景图',
		'desc' => '690×92像素',
		'id' => 'inews_t_ad_header_m',
		'type' => 'upload'
	);
	
	$options[] = array(
		'name' => '广告位',
		'desc' => '手机版网站的广告位',
		'type' => 'info'
	);	
	$options[] = array(
		'name' => '首页信息流广告A',
		'desc' => '690×120像素',
		'id' => 'inews_t_mobile_ad_a',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => '首页信息流广告A打开地址',
		'desc' => 'http://',
		'id' => 'inews_t_mobile_ad_a_url',
		'std' => '广告打开地址',
		'type' => 'text'
	);
	$options[] = array(
		'name' => '首页信息流广告B',
		'desc' => '690×120像素',
		'id' => 'inews_t_mobile_ad_b',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => '首页信息流广告B打开地址',
		'desc' => 'http://',
		'id' => 'inews_t_mobile_ad_b_url',
		'std' => '广告打开地址',
		'type' => 'text'
	);
	
	
	$options[] = array(
		'name' => '是否在文章中插入广告位',
		'desc' => '勾选则显示',
		'id' => 'inews_t_mobile_ad_posting_display',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '文章中插入广告位代码',
		'desc' => '请写入代码',
		'id' => 'inews_t_mobile_ad_posting',
		'std' => '广告代码',
		'type' => 'textarea'
	);
	
	
/*	if ( $options_categories ) {
		$options[] = array(
			'name' => __( 'Select a Category', 'theme-textdomain' ),
			'desc' => __( 'Passed an array of categories with cat_ID and cat_name', 'theme-textdomain' ),
			'id' => 'example_select_categories',
			'type' => 'select',
			'options' => $options_categories
		);
	}

	if ( $options_tags ) {
		$options[] = array(
			'name' => __( 'Select a Tag', 'options_check' ),
			'desc' => __( 'Passed an array of tags with term_id and term_name', 'options_check' ),
			'id' => 'example_select_tags',
			'type' => 'select',
			'options' => $options_tags
		);
	}

	$options[] = array(
		'name' => __( 'Select a Page', 'theme-textdomain' ),
		'desc' => __( 'Passed an pages with ID and post_title', 'theme-textdomain' ),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages
	);


	$options[] = array(
		'name' => __( 'Example Info', 'theme-textdomain' ),
		'desc' => __( 'This is just some example information you can put in the panel.', 'theme-textdomain' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Input Checkbox', 'theme-textdomain' ),
		'desc' => __( 'Example checkbox, defaults to true.', 'theme-textdomain' ),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Advanced Settings', 'theme-textdomain' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Check to Show a Hidden Text Input', 'theme-textdomain' ),
		'desc' => __( 'Click here and see what happens.', 'theme-textdomain' ),
		'id' => 'example_showhidden',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Hidden Text Input', 'theme-textdomain' ),
		'desc' => __( 'This option is hidden unless activated by a checkbox click.', 'theme-textdomain' ),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Uploader Test', 'theme-textdomain' ),
		'desc' => __( 'This creates a full size uploader that previews the image.', 'theme-textdomain' ),
		'id' => 'example_uploader',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png'
		)
	);

	$options[] = array(
		'name' =>  __( 'Example Background', 'theme-textdomain' ),
		'desc' => __( 'Change the background CSS.', 'theme-textdomain' ),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background'
	);



	$options[] = array(
		'name' => __( 'Colorpicker', 'theme-textdomain' ),
		'desc' => __( 'No color selected by default.', 'theme-textdomain' ),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color'
	);

	$options[] = array( 'name' => __( 'Typography', 'theme-textdomain' ),
		'desc' => __( 'Example typography.', 'theme-textdomain' ),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography'
	);

	$options[] = array(
		'name' => __( 'Custom Typography', 'theme-textdomain' ),
		'desc' => __( 'Custom typography options.', 'theme-textdomain' ),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options
	);

	$options[] = array(
		'name' => __( 'Text Editor', 'theme-textdomain' ),
		'type' => 'heading'
	);
*/
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

/*	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress,wplink' )
	);

	$options[] = array(
		'name' => __( 'Default Text Editor', 'theme-textdomain' ),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'theme-textdomain' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);*/

	return $options;
}