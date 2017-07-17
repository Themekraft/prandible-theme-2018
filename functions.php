<?php
/**
 * @package Boss Child Theme
 * The parent theme functions are located at /boss/buddyboss-inc/theme-functions.php
 * Add your own functions in this file.
 */

/**
 * Sets up theme defaults
 *
 * @since Boss Child Theme 1.0.0
 */
function boss_child_theme_setup()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   * Read more at: http://www.buddyboss.com/tutorials/language-translations/
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'boss', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'boss' instances in all child theme files to 'boss_child_theme'.
  // load_theme_textdomain( 'boss_child_theme', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'boss_child_theme_setup' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function boss_child_theme_scripts_styles()
{
  /**
   * Scripts and Styles loaded by the parent theme can be unloaded if needed
   * using wp_deregister_script or wp_deregister_style.
   *
   * See the WordPress Codex for more information about those functions:
   * http://codex.wordpress.org/Function_Reference/wp_deregister_script
   * http://codex.wordpress.org/Function_Reference/wp_deregister_style
   **/

  /*
   * Styles
   */
  wp_enqueue_style( 'boss-child-custom', get_stylesheet_directory_uri().'/css/custom.css' );
}
add_action( 'wp_enqueue_scripts', 'boss_child_theme_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/

// Add your own custom functions here







add_action('init', 'prandible_init_thickbox');

function prandible_init_thickbox() {
	add_thickbox();
}

//add_action( 'template_redirect', 'prandible_the_course_enrolment_actions_redirect' );
function prandible_the_course_enrolment_actions_redirect(){
	global  $post, $current_user, $woothemes_sensei;


	// Only logged in users can take a lesson
	if ( ! is_user_logged_in() ) {
		return;
	}

	// Make sure we are on a sensei view
	if( ! is_sensei() ){
		return;
	}

	// Get the Post Type
	$post_type = get_post_type($post);

	// We only want to redirect to the lesson if we visit the curse
	if( $post_type != 'course' ){
		return;
	}

	// Check if the user is taking the curse
	$is_user_taking_course = Sensei_Utils::user_started_course( $post->ID, $current_user->ID );

	// If the user does not take the curse we not need to redirect
	if( ! $is_user_taking_course ){
		return;
	}

	// Let us get all the lessons
	$course_lessons		 = $woothemes_sensei->post_types->course->course_lessons( $post->ID );
	$total_lessons		 = count( $course_lessons );

	// loop to all lessons and check if the user has finished the lesson.
	if ( 0 < $total_lessons ) {
		foreach ( $course_lessons as $lesson_item ) {

			// Check if Lesson is complete
			$user_lesson_status     = WooThemes_Sensei_Utils::user_lesson_status( $lesson_item->ID, $current_user->ID );
			$single_lesson_complete = WooThemes_Sensei_Utils::user_completed_lesson( $user_lesson_status );

			// If lesson is not completed do the redirect
			if ( ! $single_lesson_complete ) {
//				wp_redirect( get_permalink( $lesson_item->ID ) );
			}
		}
	}
}

add_action( 'wp_head', 'prandible_the_course_enrolment_actions_course_start' );
function prandible_the_course_enrolment_actions_course_start() {
	global $post, $current_user, $woothemes_sensei;

	// Check if the user is taking the course
	$is_user_taking_course = Sensei_Utils::user_started_course( $post->ID, $current_user->ID );


	if ( isset( $_POST['course_start'] )
	     && wp_verify_nonce( $_POST['woothemes_sensei_start_course_noonce'], 'woothemes_sensei_start_course_noonce' )
	     && ! $is_user_taking_course
	) {
		// Let us get all the lessons
		$course_lessons		 = $woothemes_sensei->post_types->course->course_lessons( $post->ID );
		$total_lessons		 = count( $course_lessons );

		$activity_logged = Sensei_Utils::user_start_course( $current_user->ID, $post->ID );


			// loop to all lessons and check if the user has finished the lesson.
			if ( 0 < $total_lessons ) {
				foreach ( $course_lessons as $lesson_item ) {

					// Check if Lesson is complete
					$user_lesson_status     = WooThemes_Sensei_Utils::user_lesson_status( $lesson_item->ID, $current_user->ID );
					$single_lesson_complete = WooThemes_Sensei_Utils::user_completed_lesson( $user_lesson_status );

					// If lesson is not completed do the redirect
					if ( ! $single_lesson_complete ) {
//						wp_redirect( get_permalink( $lesson_item->ID ) );
						?>

						<script type="text/javascript"> window.location = '<?php echo get_permalink( $lesson_item->ID ); ?>'; </script>

						<?php
					}
				}
			}
		}

}

function prandible_js() {
?>
    <script>
    jQuery(document).ready( function($) {

        var article = jQuery('.course-lessons-inner article').not('.lesson-completed');

        href = article.find('a').attr("href")

        jQuery('.course-meta.course-enrolment div.status.in-progress').html('<a href="' + href + '">Mache Weiter</a>');
    });
    </script>

<?php
}
add_action( 'wp_head', 'prandible_js' );

?>