<?php
namespace ElementorSingleVote\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Single_Vote extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'single-vote';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Single Vote', 'elementor-hello-world' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor-hello-world' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'elementor-hello-world' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'elementor-hello-world' ),
					'uppercase' => __( 'UPPERCASE', 'elementor-hello-world' ),
					'lowercase' => __( 'lowercase', 'elementor-hello-world' ),
					'capitalize' => __( 'Capitalize', 'elementor-hello-world' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
    }
    
    protected function check_seen_status($movieArray) {
        global $post;
        switch ($movieArray[$post->ID]['seen']) {
            case 1:
                return true;
                break;
            case 0:
            default:
                return false;
                break;
        }
    }

    protected function get_movie_rating($movieArray) {
        global $post;
        return $movieArray[$post->ID]['rating'];
    }

    protected function render_seen_ribbon() {
        echo '<div class="seen-ribbon"><div class="seen-text">Seen</div></div>';
    }

    protected function render_star_rating($seen, $rating) {
        if(is_user_logged_in()) {
            global $post;
            $html = '<div class="star-rating">';
            $html .= '<fieldset id="post-' . $post->ID .'" class="rate' . ($seen ? "" : " hidden") .'">';
            $html .= '<input id="rate2-star5-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="5" '. ($rating == 5 ? " checked" : "" ) .'/>';
            $html .= '<label for="rate2-star5-'.$post->ID.'" title="Awesome">5</label>';
            $html .= '<input id="rate2-star5-half-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="4.5" '. ($rating == 4.5 ? " checked" : "" ) .'/>';
            $html .= '<label class="star-half" for="rate2-star5-half-'.$post->ID.'" title="Excellent">4.5</label>';
            $html .= '<input id="rate2-star4-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="4" '. ($rating == 4 ? " checked" : "" ) .'/>';
            $html .= '<label for="rate2-star4-'.$post->ID.'" title="Very good">4</label>';
            $html .= '<input id="rate2-star3-half-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="3.5" '. ($rating == 3.5 ? " checked" : "" ) .'/>';
            $html .= '<label class="star-half" for="rate2-star3-half-'.$post->ID.'" title="Good">3.5</label>';
            $html .= '<input id="rate2-star3-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="3" '. ($rating == 3 ? " checked" : "" ) .'/>';
            $html .= '<label for="rate2-star3-'.$post->ID.'" title="Satisfactory">3</label>';
            $html .= '<input id="rate2-star2-half-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="2.5" '. ($rating == 2.5 ? " checked" : "" ) .'/>';
            $html .= '<label class="star-half" for="rate2-star2-half-'.$post->ID.'" title="Unsatisfactory">2.5</label>';
            $html .= '<input id="rate2-star2-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="2" '. ($rating == 2 ? " checked" : "" ) .'/>';
            $html .= '<label for="rate2-star2-'.$post->ID.'" title="Bad">2</label>';
            $html .= '<input id="rate2-star1-half-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="1.5" '. ($rating == 1.5 ? " checked" : "" ) .'/>';
            $html .= '<label class="star-half" for="rate2-star1-half-'.$post->ID.'" title="Very bad">1.5</label>';
            $html .= '<input id="rate2-star1-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="1" '. ($rating == 1 ? " checked" : "" ) .'/>';
            $html .= '<label for="rate2-star1-'.$post->ID.'" title="Awful">1</label>';
            $html .= '<input id="rate2-star0-half-'.$post->ID.'" type="radio" name="movie-rate-'.$post->ID.'" value="0.5" '. ($rating == 0.5 ? " checked" : "" ) .'/>';
            $html .= '<label class="star-half" for="rate2-star0-half-'.$post->ID.'" title="Horrific">0.5</label>';
            $html .= '</fieldset></div>';
            echo $html;
            }
        }

        protected function render_mark_as_seen_toggle($seen) {
            if(is_user_logged_in()) {
            global $post;
                switch ($seen) {
                    case true:
                        echo '<button class="movie-seen-toggle seen post-' . $post->ID . '">Mark as Unseen</button>';
                        break;
                    case false:
                    default:
                        echo '<button class="movie-seen-toggle unseen post-' . $post->ID . '">Mark as Seen</button>';
                        break;			
                }
            }
        }

        protected function render_log_in_button() {
            $html = "";
            $html .= '<div class="please-login">';
            $html .= '<a href="/login/">';
            $html .= '<button class="elementor-button-link elementor-button elementor-size-sm">Login to rate</button>';
            $html .= '</a>';
            $html .= '</div>';
            echo $html;
        }

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();
        
        $movieArray = [];
        $movieMetaKey = 'movie-statuses';

        if (is_user_logged_in()) {
            $movieArray = (get_user_meta(get_current_user_id(), $movieMetaKey, true)) ? get_user_meta(get_current_user_id(), $movieMetaKey, true) : "" ;
        }

        $seenBool = $this->check_seen_status($movieArray);
        $movieRating = $this->get_movie_rating($movieArray);

        echo '<div class="title">';
		echo '<h2>'. $settings['title'] .'</h2>';
		echo '</div>';
            
        if(is_user_logged_in()) {
            echo '<div class="user-rating-widget">';
            //$this->render_seen_ribbon();
            
            $this->render_mark_as_seen_toggle($seenBool);

            $this->render_star_rating($seenBool, $movieRating);		
            echo '</div>';
        } else {
            $this->render_log_in_button();
        }

	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 
	protected function _content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	}*/
}