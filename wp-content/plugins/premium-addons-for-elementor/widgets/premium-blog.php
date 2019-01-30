<?php
namespace Elementor;

use Elementor\Core\Responsive\Responsive;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Premium_Blog extends Widget_Base {
    public function get_name() {
        return 'premium-addon-blog';
    }

    public function get_title() {
		return \PremiumAddons\Helper_Functions::get_prefix() . ' Blog';
	}

    public function is_reload_preview_required(){
        return true;
    }
    
    public function get_script_depends(){
        return [
            'isotope-js',
            'premium-addons-js'
        ];
    }

    public function get_icon() {
        return 'pa-blog';
    }

    public function get_categories() {
        return [ 'premium-elements' ];
    }

    // Adding the controls fields for the premium blog
    // This will controls the animation, colors and background, dimensions etc
    protected function _register_controls() {

        /* Start Content Section */
        $this->start_controls_section('premium_blog_general_settings',
                [
                    'label'         => __('Image', 'premium-addons-for-elementor'),
                    ]
                );
        
        /*Hover Image Effect*/ 
        $this->add_control('premium_blog_hover_image_effect',
                [
                    'label'         => __('Hover Effect', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SELECT,
                    'description'   => __('Choose a hover effect for the image','premium-addons-for-elementor'),
                    'options'       => [
                        'none'  => __('None', 'premium-addons-for-elementor'),
                        'zoomin' => __('Zoom In', 'premium-addons-for-elementor'),
                        'zoomout'=> __('Zoom Out', 'premium-addons-for-elementor'),
                        'scale'  => __('Scale', 'premium-addons-for-elementor'),
                        'gray'   => __('Grayscale', 'premium-addons-for-elementor'),
                        'blur'   => __('Blur', 'premium-addons-for-elementor'),
                        'bright' => __('Bright', 'premium-addons-for-elementor'),
                        'sepia'  => __('Sepia', 'premium-addons-for-elementor'),
                        'trans'  => __('Translate', 'premium-addons-for-elementor'),
                    ],
                    'default'       => 'zoomin',
                    'label_block'   => true
                ]
                );
        
        /*Hover Image Effect*/ 
        $this->add_control('premium_blog_hover_color_effect',
                [
                    'label'         => __('Color Effect', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SELECT,
                    'description'   => __('Choose an overlay color effect','premium-addons-for-elementor'),
                    'options'       => [
                        'none'     => __('None', 'premium-addons-for-elementor'),
                        'framed'   => __('Framed', 'premium-addons-for-elementor'),
                        'diagonal' => __('Diagonal', 'premium-addons-for-elementor'),
                        'bordered' => __('Bordered', 'premium-addons-for-elementor'),
                        'squares'  => __('Squares', 'premium-addons-for-elementor'),
                    ],
                    'default'       => 'framed',
                    'label_block'   => true
                ]
                );
        
        /*End Premium Blog*/
        $this->end_controls_section();
        
        /*Start Content Settings Section*/
        $this->start_controls_section('premium_blog_content_settings',
                [
                    'label'         => __('Content', 'premium-addons-for-elementor'),
                    ]
                );
        
        /*Categories Filter*/
        $this->add_control('premium_blog_categories',
            [
                'label'             => __( 'Categories', 'essential-addons-elementor' ),
                'type'              => Controls_Manager::SELECT2,
                'description'       => __('Select the categories you want to show','premium-addons-for-elementor'),
                'label_block'       => true,
                'multiple'          => true,
                'options'           => premium_addons_post_type_categories(),        
            ]
        );
        
        $this->add_control('premium_blog_title_tag',
			[
				'label'			=> __( 'Title HTML Tag', 'premium-addons-for-elementor' ),
				'description'	=> __( 'Select a heading tag for the post title.', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> 'h2',
				'options'       => [
                        'h1'    => 'H1',
                        'h2'    => 'H2',
                        'h3'    => 'H3',
                        'h4'    => 'H4',
                        'h5'    => 'H5',
                        'h6'    => 'H6',
                        ],
				'label_block'	=> true,
			]
		);
        
        /*Grid*/ 
        $this->add_control('premium_blog_grid',
                [
                    'label'         => __('Grid', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    ]
                );
        
        /*Masonry*/
        $this->add_control('premium_blog_masonry',
                [
                    'label'         => __('Masonry', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'return_value'  => 'true',
                    'condition'     => [
                            'premium_blog_grid' => 'yes'
                        ]
                    ]
                );
        
        /*Grid Number of Columns*/
        $this->add_control('premium_blog_columns_number',
                [
                    'label'             => __('Number of Columns', 'premium-addons-for-elementor'),
                    'type'              => Controls_Manager::SELECT,
                    'options'           => [
                        '50%'   => __('2 Columns', 'premium-addons-for-elementor'),
                        '33.33%'=> __('3 Columns', 'premium-addons-for-elementor'),
                        '25%'   => __('4 Columns', 'premium-addons-for-elementor'),
                    ],
                    'default'           => '50%',
                    'selectors'         => [
                        '{{WRAPPER}} .premium-blog-post-container'  => 'width: {{VALUE}}; float:left;'
                    ],
                    'condition'         => [
                        'premium_blog_grid' =>  'yes',
                        ]
                    ]
                );
        
        /*Grid Spacing*/
        $this->add_responsive_control('premium_blog_posts_spacing',
                [
                    'label'         => __('Spacing', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%', "em"],
                    'range'         => [
                        'px'    => [
                            'min'   => 1, 
                            'max'   => 200,
                            ],
                        ],
                    'condition'     => [
                        'premium_blog_grid'   => 'yes'
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-post-container' => 'padding: {{SIZE}}{{UNIT}};'
                      ]
                    ]
                );
        
        /*Excerpt*/ 
        $this->add_control('premium_blog_excerpt',
                [
                    'label'         => __('Excerpt', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Excerpt is used for article summary with a link to the whole entry. The default except length is 55','premium-addons-for-elementor'),
                    'default'       => 'yes',
                    ]
                );

        /*Excerpt Length*/
        $this->add_control('premium_blog_excerpt_length',
                [
                    'label'         => __('Excerpt Length', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 55,
                    'label_block'   => true,
                    'condition'     => [
                        'premium_blog_excerpt'  => 'yes',
                        ]
                    ]
                );
        
        /*Excerpt Type*/ 
        $this->add_control('premium_blog_excerpt_type',
                [
                    'label'         => __('Excerpt Type', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SELECT,
                    'options'       => [
                        'dots'   => __('Dots', 'premium-addons-for-elementor'),
                        'link'   => __('Link', 'premium-addons-for-elementor'),
                    ],
                    'default'       => 'dots',
                    'label_block'   => true
                ]
                );
        
        /*Excerpt Text*/
        $this->add_control('premium_blog_excerpt_text',
			[
				'label'			=> __( 'Link Text', 'premium-addons-for-elementor' ),
				'type'			=> Controls_Manager::TEXT,
                'default'       => __('continue reading','premium-addons-for-elementor'),
                'condition'     => [
                    'premium_blog_excerpt'      => 'yes',
                    'premium_blog_excerpt_type' => 'link'
                ]
			]
		);
        
        /*Author Meta*/ 
        $this->add_control('premium_blog_author_meta',
                [
                    'label'         => __('Author Meta', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'default'       => 'yes',
                    ]
                );
        
        /*Date Meta*/ 
        $this->add_control('premium_blog_date_meta',
                [
                    'label'         => __('Date Meta', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'default'       => 'yes',
                    ]
                );
        
        /*Categories Meta*/ 
        $this->add_control('premium_blog_categories_meta',
                [
                    'label'         => __('Categories Meta', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Display or hide categories mata','premium-addons-for-elementor'),
                    'default'       => 'yes',
                    ]
                );
        
        /*Comments Meta*/ 
        $this->add_control('premium_blog_comments_meta',
                [
                    'label'         => __('Comments Meta', 'premium-addons-for-elementor'),
                    'description'   => __('Display or hide comments mata','premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'default'       => 'yes',
                    ]
                );
        
        /*Tags Meta*/ 
        $this->add_control('premium_blog_tags_meta',
                [
                    'label'         => __('Tags Meta', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Display or hide post tags','premium-addons-for-elementor'),
                    'default'       => 'yes',
                    ]
                );
        
        /*Post Format Icon*/
        $this->add_control('premium_blog_post_format_icon',
            [
                'label'             => __( 'Post Format Icon', 'essential-addons-elementor' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
            ]
        );
        
        /*Edit Post Meta*/ 
        $this->add_control('premium_blog_edit_post',
                [
                    'label'         => __('Edit Post Icon', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Display or hide edit post option','premium-addons-for-elementor'),
                    'default'       => 'yes',
                    ]
                );
        
        /*Pagination*/ 
        $this->add_control('premium_blog_paging',
                [
                    'label'         => __('Pagination', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Pagination is the process of dividing the posts into discrete pages','premium-addons-for-elementor'),
                    ]
                );

        $this->add_control('premium_blog_new_tab',
                [
                    'label'         => __('Links in New Tab', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SWITCHER,
                    'description'   => __('Enable links to be opened in a new tab','premium-addons-for-elementor'),
                    'default'       => 'yes',
                    ]
                );
 
        /*Number of Posts*/
		$this->add_control('premium_blog_number_of_posts',
                [
                    'label'         => __('Posts Per Page', 'premium-addons-for-elementor'),
                    'description'   => __('Choose how many posts do you want to be displayed per page','premium-addons-for-elementor'),
                    'type'          => Controls_Manager::NUMBER,
					'min'			=> 1,
					'default'		=> 1,
                    ]
                );
		
		/*Posts Offset*/
		$this->add_control('premium_blog_offset',
			[
				'label' 			=> __( 'Offset Count', 'premium-addons-for-elementor' ),
                'description'   => __('The index of post to start with','premium-addons-for-elementor'),
				'type' 				=> Controls_Manager::NUMBER,
                'default' 			=> '0',
				'min' 				=> '0',
			]
		);
        
        /*Front Text Align*/
        $this->add_responsive_control('premium_flip_text_align',
                [
                    'label'         => __( 'Alignment', 'premium-addons-for-elementor' ),
                    'type'          => Controls_Manager::CHOOSE,
                    'options'       => [
                        'left'      => [
                            'title'=> __( 'Left', 'premium-addons-for-elementor' ),
                            'icon' => 'fa fa-align-left',
                            ],
                        'center'    => [
                            'title'=> __( 'Center', 'premium-addons-for-elementor' ),
                            'icon' => 'fa fa-align-center',
                            ],
                        'right'     => [
                            'title'=> __( 'Right', 'premium-addons-for-elementor' ),
                            'icon' => 'fa fa-align-right',
                            ],
                        ],
                    'default'       => 'left',
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-content-wrapper' => 'text-align: {{VALUE}};',
                        ],
                    ]
                );

       
        /*End Content Section*/
        $this->end_controls_section();
        
        /*Start Color Style Section*/
        $this->start_controls_section('premium_blog_image_style_section',
                [
                    'label'         => __('Image', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    ]
                );
        
        /*Plus Icon Color*/
        $this->add_control('premium_blog_plus_color',
                [
                    'label'         => __('Icon Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-thumbnail-container:before, {{WRAPPER}} .premium-blog-thumbnail-container:after' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Overlay Color*/
        $this->add_control('premium_blog_overlay_color',
                [
                    'label'         => __('Overlay Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-framed-effect, {{WRAPPER}} .premium-blog-bordered-effect,{{WRAPPER}} .premium-blog-squares-effect:before,{{WRAPPER}} .premium-blog-squares-effect:after,{{WRAPPER}} .premium-blog-squares-square-container:before,{{WRAPPER}} .premium-blog-squares-square-container:after, {{WRAPPER}} .premium-blog-format-container:hover,{{WRAPPER}} .premium-blog-pagination-container .current' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Bordered Effect Border Color*/
        $this->add_control('premium_blog_border_effect_color',
                [
                    'label'         => __('Border Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'description'   => 'Used with Bordered style only',
                    'condition'     => [
                      'premium_blog_hover_color_effect'  => 'bordered',
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-bordered-border-container' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_blog_title_style_section',
                [
                    'label'         => __('Title', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    ]
                );
        
        /*Titles Color*/
        $this->add_control('premium_blog_title_color',
                [
                    'label'         => __('Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-entry-title a'  => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_blog_title_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-blog-entry-title',
                    ]
                );
        
        /*Titles Hover Color*/
        $this->add_control('premium_blog_title_hover_color',
                [
                    'label'         => __('Hover Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-entry-title:hover a'  => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_blog_meta_style_section',
                [
                    'label'         => __('Meta', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    ]
                );
        
        /*Meta Color*/
        $this->add_control('premium_blog_meta_color',
                [
                    'label'         => __('Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-entry-meta, {{WRAPPER}} .premium-blog-entry-meta a, {{WRAPPER}} .premium-blog-post-content .premium-blog-excerpt-link'  => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_blog_meta_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-blog-entry-meta a,{{WRAPPER}} .premium-blog-post-content .premium-blog-excerpt-link',
                    ]
                );
        
        /*Meta Hover Color*/
        $this->add_control('premium_blog_meta_hover_color',
                [
                    'label'         => __('Hover Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-entry-meta a:hover, {{WRAPPER}} .premium-blog-post-content .premium-blog-excerpt-link:hover'  => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_blog_content_style_section',
                [
                    'label'         => __('Content', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    ]
                );
        
        /*Post Content Color*/
        $this->add_control('premium_blog_post_content_color',
                [
                    'label'         => __('Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_3,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-post-content'  => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Post Content Typography*/
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_blog_content_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-blog-post-content',
                    ]
                );
        
        
        /*Content Background Color*/
        $this->add_control('premium_blog_content_background_color',
                [
                    'label'         => __('Background Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'default'       => '#f5f5f5',
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-content-wrapper'  => 'background-color: {{VALUE}};',
                        ]
                    ]
                );
        
        $this->end_controls_section();
        
        $this->start_controls_section('premium_blog_tags_style_section',
                [
                    'label'         => __('Tags', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    ]
                );
        
        /*Tags Color*/
        $this->add_control('premium_blog_tags_color',
                [
                    'label'         => __('Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-post-tags-container, {{WRAPPER}} .premium-blog-post-tags-container a'  => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Tags Typography*/
        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name'          => 'premium_blog_tags_typo',
                    'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                    'selector'      => '{{WRAPPER}} .premium-blog-post-tags-container a',
                    ]
                );
        
        /*Tags Hover Color*/
        $this->add_control('premium_blog_tags_hoer_color',
                [
                    'label'         => __('Hover Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-post-tags-container a:hover'  => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        $this->end_controls_section();
        
        /*Post Format Icon*/
        $this->start_controls_section('premium_blog_format_style_section',
                [
                    'label'         => __('Post Format Icon', 'premium-addons-for-elementor'),
                    'tab'           => Controls_Manager::TAB_STYLE,
                    'condition'     => [
                        'premium_blog_post_format_icon' => 'yes'
                        ]
                    ]
                );
        
        $this->add_control('premium_blog_format_icon_size',
                [
                    'label'         => __('Size', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::SLIDER,
                    'description'   => __('Choose icon size in (PX, EM)', 'premium-addons-for-elementor'),
                    'range'         => [
                        'em'    => [
                            'min'       => 1,
                            'max'       => 10,
                        ],
                    ],
                    'size_units'    => ['px', "em"],
                    'label_block'   => true,
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-format-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                );
        
        /*Post Format Icon Color*/
        $this->add_control('premium_blog_format_icon_color',
                [
                    'label'         => __('Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-format-container i'  => 'color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Post Format Icon Color*/
        $this->add_control('premium_blog_format_icon_hover_color',
                [
                    'label'         => __('Hover Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-format-container:hover i'  => 'color: {{VALUE}};',
                        ]
                    ]
                );

        /*Post Format Background Color*/
        $this->add_control('premium_blog_format_back_color',
                [
                    'label'         => __('Background Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-format-container'  => 'background-color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*Post Format Hover Background Color*/
        $this->add_control('premium_blog_format_back_hover_color',
                [
                    'label'         => __('Hover Background Color', 'premium-addons-for-elementor'),
                    'type'          => Controls_Manager::COLOR,
                    'scheme'        => [
                        'type'  => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_2,
                    ],
                    'selectors'     => [
                        '{{WRAPPER}} .premium-blog-format-container:hover'  => 'background-color: {{VALUE}};',
                        ]
                    ]
                );
        
        /*End Format Icon Style Section*/
        $this->end_controls_section();
        
        /*Pagination Style*/
        $this->start_controls_section('premium_blog_pagination_Style',
            [
                'label'         => __('Pagination Style', 'premium-addons-for-elementor'),
                'tab'          => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'premium_blog_paging'   => 'yes',
                ]
            ]);
        
        $this->start_controls_tabs('premium_blog_pagination_colors');
        
        $this->start_controls_tab('premium_blog_pagination_nomral',
            [
                'label'         => __('Normal', 'premium-addons-for-elementor'),
                
            ]);
        
        $this->add_control('prmeium_blog_pagination_color', 
            [
                'label'         => __('Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-blog-pagination-container li a, {{WRAPPER}} .premium-blog-pagination-container li span' => 'color: {{VALUE}};'
                ]
            ]);
        
        $this->add_control('prmeium_blog_pagination_back_color', 
            [
                'label'         => __('Background Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-blog-pagination-container li a, {{WRAPPER}} .premium-blog-pagination-container li span' => 'background-color: {{VALUE}};'
                ]
            ]);
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('premium_blog_pagination_hover',
            [
                'label'         => __('Hover', 'premium-addons-for-elementor'),
                
            ]);
        
        $this->add_control('prmeium_blog_pagination_hover_color', 
            [
                'label'         => __('Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-blog-pagination-container li:hover a, {{WRAPPER}} .premium-blog-pagination-container li:hover span' => 'color: {{VALUE}};'
                ]
            ]);
        
        $this->add_control('prmeium_blog_pagination_back_hover_color', 
            [
                'label'         => __('Background Color', 'premium-addons-for-elementor'),
                'type'          => Controls_Manager::COLOR,
                'scheme'        => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .premium-blog-pagination-container li:hover a, {{WRAPPER}} .premium-blog-pagination-container li:hover span' => 'background-color: {{VALUE}};'
                ]
            ]);
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        /*End Paging Style Section*/
        $this->end_controls_section();
       
    }
    
    protected function get_blog_responsive_style() {
        
        $breakpoints = Responsive::get_breakpoints();
        
        $style = '<style>';
        $style .= '@media ( max-width: ' . $breakpoints['lg'] . 'px ) {';
        $style .= '.premium-blog-entry-title {';
        $style .= 'line-height: 1;';
        $style .= '}';
        $style .= '.premium-blog-entry-title a {';
        $style .= 'font-size: 18px;';
        $style .= '}';
        $style .= '}';
        $style .= '@media ( max-width: ' . $breakpoints['md'] . 'px ) {';
        $style .= '.premium-blog-post-container {';
        $style .= 'width: 100% !important;';
        $style .= '}';
        $style .= '.premium-blog-content-wrapper {';
        $style .= 'padding: 15px;';
        $style .= '}';
        $style .= '.premium-blog-entry-title {';
        $style .= 'line-height: 1;';
        $style .= '}';
        $style .= '.premium-blog-entry-title a {';
        $style .= 'font-size: 16px;';
        $style .= '}';
        $style .= '}';
        $style .= '</style>';
        
        return $style;
        
    }

    protected function render() {
        
        if ( get_query_var('paged') ) { 
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');             
        } else {
            $paged = 1;
        }
        
        // get our input from the widget settings.
        $settings = $this->get_settings();
        
        if($settings['premium_blog_new_tab'] == 'yes'){
            $target = '_blank';
        } else {
            $target = '_self';
        }

        $image_effect = $settings['premium_blog_hover_image_effect'];
        
        $post_effect = $settings['premium_blog_hover_color_effect'];
        
        $offset = $settings['premium_blog_offset'];
        
        $post_per_page = $settings['premium_blog_number_of_posts'];
        
        $new_offset = $offset + ( ( $paged - 1 ) * $post_per_page );
        
        $post_args = premium_blog_get_post_settings($settings);

        $posts = premium_blog_get_post_data($post_args, $paged , $new_offset);
        
        $excerpt_type = $settings['premium_blog_excerpt_type'];
        $excerpt_text = $settings['premium_blog_excerpt_text'];
        $date_format = get_option('date_format');
        switch($settings['premium_blog_columns_number']){
            case '50%' :
                $col_number = 'col-2';
                break;
            case '33.33%' :
                $col_number = 'col-3';
                break;
            case '25%' :
                $col_number = 'col-4';
                break;
        }
        
    ?>
        <div class="premium-blog-wrap <?php echo esc_attr($col_number); ?>" data-pa-masonry="<?php echo esc_attr($settings['premium_blog_masonry']); ?>">
        <?php
        if( count( $posts ) ){
            global $post;
            foreach($posts as $post){
                setup_postdata($post);
            ?>
                <div class="premium-blog-post-container">
                    <div class="premium-blog-thumb-effect-wrapper">
                        <div class="premium-blog-thumbnail-container <?php echo 'premium-blog-' . $image_effect . '-effect';?>">
                            <a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>"><?php the_post_thumbnail('full'); ?></a>
                        </div>
                        <div class="premium-blog-effect-container <?php echo 'premium-blog-'. $post_effect . '-effect'; ?>">
                            <a class="premium-blog-post-link" href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>"></a>
                            <?php if( $settings['premium_blog_hover_color_effect'] === 'bordered' ) : ?>
                            <div class="premium-blog-bordered-border-container"></div>
                            <?php elseif( $settings['premium_blog_hover_color_effect'] === 'squares' ) : ?>
                            <div class="premium-blog-squares-square-container"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="premium-blog-content-wrapper <?php echo (!has_post_thumbnail()) ? 'empty-thumb' : '';  ?>">
                        <div class="premium-blog-inner-container">
                            <?php if( $settings['premium_blog_post_format_icon'] === 'yes' ) : ?>
                            <div class="premium-blog-format-container">
                                <a class="premium-blog-format-link" href="<?php the_permalink(); ?>" title="<?php if( get_post_format() === ' ') : echo 'standard' ; else : echo get_post_format();  endif; ?>" target="<?php echo esc_attr($target); ?>"><i class="premium-blog-format-icon fa fa-<?php if ( get_post_format() === 'aside' ) : echo 'file-text-o'; ?>
                                <?php elseif ( get_post_format() === 'audio' ) :  echo 'music'; ?>
                                <?php elseif ( get_post_format() === 'gallery' ) : echo 'file-image-o'; ?>
                                <?php elseif ( get_post_format() === 'image' ) : echo 'picture-o'; ?>
                                <?php elseif ( get_post_format() === 'link' ) : echo 'link'; ?>
                                <?php elseif ( get_post_format() === 'quote' ) :echo 'quote-left';  ?>
                                <?php elseif ( get_post_format() === 'video' ) : echo 'video-camera'; ?>
                                <?php else : echo 'thumb-tack'; ?>
                                <?php endif; ?>"></i></a>
                            </div>
                            <?php endif; ?>
                            <div class="premium-blog-entry-container">
                                <<?php echo $settings['premium_blog_title_tag']; ?> class="premium-blog-entry-title"><a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>"><?php the_title(); ?></a></<?php echo $settings['premium_blog_title_tag']; ?>>
                                <div class="premium-blog-entry-meta" style="<?php if( $settings['premium_blog_post_format_icon'] !== 'yes' ) : echo 'margin-left:0px'; endif; ?>">
                                    <?php if( $settings['premium_blog_author_meta'] === 'yes' ) : ?>
                                    <span class="premium-blog-post-author premium-blog-meta-data"><i class="fa fa-user fa-fw"></i><?php the_author_posts_link();?></span>
                                    <?php endif; ?>
                                    <?php if( $settings['premium_blog_date_meta'] === 'yes' ) : ?>
                                    <span class="premium-blog-post-time premium-blog-meta-data"><i class="fa fa-calendar fa-fw"></i><a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>"><?php the_time($date_format); ?></a></span>
                                    <?php endif; ?>
                                    <?php if( $settings['premium_blog_categories_meta'] === 'yes' ) : ?>
                                    <span class="premium-blog-post-categories premium-blog-meta-data"><i class="fa fa-align-left fa-fw"></i><?php the_category(', '); ?></span>
                                    <?php endif; ?>
                                    <?php if( $settings['premium_blog_comments_meta'] === 'yes' ) : ?>
                                    <span class="premium-blog-post-comments premium-blog-meta-data"><i class="fa fa-comments-o fa-fw"></i><a href="<?php the_permalink(); ?>" target="<?php echo esc_attr($target); ?>"><?php comments_number('0 Comments', '1', '%'); ?>  </a></span>
                                    <?php endif; ?>
                                    <?php if( $settings['premium_blog_edit_post'] === 'yes' ) : ?>
                                    <span class="premium-blog-post-edit  premium-blog-meta-data"><i class="fa fa-pencil fa-fw"></i><?php edit_post_link(); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="premium-blog-post-content" style="<?php if ( $settings['premium_blog_post_format_icon'] !== 'yes' ) : echo 'margin-left:0px;'; endif; ?>">
                            <?php 
                            if ( $settings['premium_blog_excerpt'] === 'yes' ) : 
                                echo  premium_addons_get_excerpt_by_id(get_the_ID(),$settings['premium_blog_excerpt_length'],$excerpt_type,$excerpt_text);
                         else: the_content(); 
                         endif; ?>
                        </div>
                        <div class="premium-blog-post-tags-container" style="<?php if( $settings['premium_blog_post_format_icon'] !== 'yes' ) : echo 'margin-left:0px;'; endif; ?>">
                            <?php if( $settings['premium_blog_tags_meta'] === 'yes' && the_tags() != '' ) : ?>
                            <span class="premium-blog-post-tags"><i class="fa fa-tags fa-fw"></i><?php the_tags(' ', ', '); ?> </span>
                            <?php endif; ?>
                        </div>   
                    </div>
                </div>
                    <?php }?>
                    <div class="premium-blog-clear-fix"></div>
                </div>
    <?php if ( $settings['premium_blog_paging'] === 'yes' ) : ?>
        <div class="premium-blog-pagination-container">
                    <?php 
                    $count_posts = wp_count_posts();
                    $published_posts = $count_posts->publish;

                    $page_tot = ceil( ( $published_posts - $offset ) / $settings['premium_blog_number_of_posts'] );
                    if ( $page_tot > 1 ) {
                        $big        = 999999999;
                        echo paginate_links( array(
                            'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ),
                            'format'    => '?paged=%#%',
                            'current'   => max( 1, $paged ),
                            'total'     => $page_tot,
                            'prev_next' => true,
                            'prev_text' => sprintf( "&lsaquo; %s", __("Previous","premium-addons-for-elementor") ),
                            'next_text' => sprintf( "%s &rsaquo;", __("Next","premium-addons-for-elementor") ),
                            'end_size'  => 1,
                            'mid_size'  => 2,
                            'type'      => 'list'
                            ));
                        }
                    ?>
        </div>
    <?php
        endif;
        echo $this->get_blog_responsive_style();
        wp_reset_postdata();   
        }
    }
}
