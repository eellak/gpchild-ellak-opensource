<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Generate
 */

get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?> itemprop="mainContentOfPage" role="main">
			<?php do_action('generate_before_main_content'); ?>
                        <?php
                        $list_of_developers=array(); //associative array of developers with number of contrbutions
                        echo wp_upload_dir()['basedir'].'/../../ellak_github_developers/orgs/sum_contr.txt';   
                        //access the file with the list of the developer logins and the contributions total
                        if(file_exists(wp_upload_dir()['basedir'].'/../../ellak_github_developers/sum_contr.txt')){
                            echo 'to arxeio vrethike';
                            $sum_contr=fopen(wp_upload_dir()['basedir'].'/../../ellak_github_developers/sum_contr.txt');
                            while (! feof($sum_contr)){
                                $list_of_developers[]=fgetcsv($sum_contr);
                            }
                        }
                        
//                        foreach($list_of_developers as $dev_entry){
//                            echo $dev_entry[1].': '.$dev_entry[0];
//                        }
                        
                        //file_exists(get_template_directory_uri().'')
                        $parsed_json_file;
                        
                        ?>
			<?php do_action('generate_after_main_content'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer();
