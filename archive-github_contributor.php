<?php
/**
 * The template for displaying github_contributor custom post types.
 *
 *
 * @package Generate
 */

get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?> itemprop="mainContentOfPage" role="main">
                    <?php do_action('generate_before_main_content'); ?>
                    <div class='inside-article'>
                        <div class='ellak-contributors title-wrapper'>
                            <div class='ellak-contributors title text'>Github Developers in Greece</div>
                            <div class='ellak-contributors title controls'>
                                <div class='ellak-contributors sort-controls'>
                                    <?php $topothesia_terms=get_terms('github_contr_topothesia'); ?>
                                    <form id='contr-main-form' name='contr-main-form' action='<?php echo esc_url(admin_url('admin-post.php')); ?>' method='post'>
                                        <div class='ellak-contributors sort-controls ellak-label'>
                                            Sort by: 
                                        </div>
                                        <div class='ellak-contributors sort-controls sort-control-line'>
                                                <input type='radio' name='sort' value='contributor_username'>
                                                <span class='text'>alphabetically</span>
                                        </div>
                                        <div class='ellak-contributors sort-controls sort-control-line'>
                                                <input type='radio' name='sort' value='contributions_number'>
                                                <span class='text'>contributions</span>
                                        </div>
                                        <div class='ellak-contributors sort-controls sort-control-line'>
                                                <input type='radio' name='sort' value='followers_number'>
                                                <span class='text'>followers</span>
                                        </div>
<!--                                        <div class='ellak-contributors sort-controls by-language'>
                                                <span class='text'>language</span>
                                                <select name='contr-language'>
                                                </select>
                                        </div>-->
                                        <div class='ellak-contributors sort-controls by-location sort-control-line'>
                                            <span class='text'>location: </span>
                                            <select class='ellak-contributors sort-controls topothesia-select' name='topothesia'>
                                                <option value='null_option'>ALL CITIES</option>
                                                <?php foreach($topothesia_terms as $topothesia_term):?>
                                                <option value='<?php echo urldecode($topothesia_term->term_id);?>'><?php echo $topothesia_term->name;?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type='hidden' name='action' value='handle_github_contr_query'>
                                        <div class='ellak-contributors sort-controls submit-button'>
                                            <button type='submit' value='submit'>Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class='ellak-github-contributors github_contributors-query-details main-wrapper'>
                            <div class='ellak-github-contributors github-contributors-query-details padding-div'>
                                <?php
                                if($wp_query->found_posts<=0){
                                    $parameters_string="<div class='ellak-github-contributors github-contributors-query-details query-details-title-label'>".$wp_query->found_posts.' records satisfy the given filterstajin:</div>'.PHP_EOL;
                                }
                                else if($wp_query->found_posts<=1){
                                    $parameters_string="<div class='ellak-github-contributors github-contributors-query-details query-details-title-label'>".$wp_query->found_posts.' record satisfies the given filters:</div>'.PHP_EOL;
                                }
                                else {
                                    $parameters_string="<div class='ellak-github-contributors github-contributors-query-details query-details-title-label'>".$wp_query->found_posts.' records satisfy the given filters:</div>'.PHP_EOL;
                                }
                                    $tmp_topothesia=get_term_by('term_id', get_query_var('topothesia'), 'github_contr_topothesia');
                                    if($tmp_topothesia)
                                        $parameters_string.="<div class='ellak-github-contributors github-contributors-query-details query-details-line><span class='ellak-github-contributors github-contributors-query-details query-details-label'>location: </span><span class='ellak-github-contributors github-contributors-query-details query-details-value'>".$tmp_topothesia->name."</span></div>".PHP_EOL;
                                    $tmp_sort=get_query_var('sort');
                                    if($tmp_sort)
                                        if($tmp_sort==='contributor_username')
                                            $tmp_sort_label='alphabetically';
                                        if($tmp_sort==='followers_number')
                                            $tmp_sort_label='followers';
                                        if($tmp_sort==='contributions_number')
                                            $tmp_sort_label='contributions';
                                        $parameters_string.="<div class='ellak-github-contributors github-contributors-query-details query-details-line><span class='ellak-github-contributors github-contributors-query-details query-details-label'>sorting: </span><span class='ellak-github-contributors github-contributors-query-details query-details-value'>".$tmp_sort."</span></div>".PHP_EOL;
                                    echo $parameters_string;
                                ?> 
                            </div>
                        </div>
                        
                        <div class='ellak-contributors contr-entry-set main-wrapper row'>
                            <?php
                            if(have_posts()):
                                while(have_posts()):
                                    the_post();?>
                                    <div class='ellak-contributors contr-entry main-wrapper col-md-4 col-sm-6 col-xs-12'>
                                        <div class='ellak-contributors contr-entry title-text-wrapper'>
                                            <div class='ellak-contributors contr-entry title-text' role='button'>
                                                <?php
                                                $avatar_url=get_post_meta(get_the_id(), 'contributor_avatar_url')[0];
                                                echo "<img src='$avatar_url' class='ellak-contributors contributor-avatar'>";
                                                echo '<span class="ellak-contributors contributor-username-label">';
                                                the_title();
                                                echo '</span>'
                                                ?>
                                            </div>
                                        </div>
                                        <div id='<?php the_ID(); ?>-details' class='ellak-contributors contr-entry details-container collapse'>
                                            <div class='ellak-contributors contr-entry details-wrapper'>
                                                <?php $tmp=get_post_meta(get_the_id(), 'contributor_full_name')[0];
                                                if(isset($tmp) && strcmp($tmp, '')):
                                                ?>
                                                <div class='ellak-contributors contr-entry details-entry'>
                                                    <span class='ellak-contributors contr-entry details-label'>Full name: </span>
                                                    <span class='ellak-contributors contr-entry details-value'><?php echo get_post_meta(get_the_id(), 'contributor_full_name')[0]; ?></span>
                                                </div>
                                                <?php endif?>
                                                <?php $tmp=get_post_meta(get_the_id(), 'contributor_email')[0];
                                                if(isset($tmp) && strcmp($tmp, '')):
                                                ?>
                                                <div class='ellak-contributors contr-entry details-entry'>
                                                    <span class='ellak-contributors contr-entry details-label'>E-mail: </span>
                                                    <span class='ellak-contributors contr-entry details-value'><?php echo get_post_meta(get_the_id(), 'contributor_email')[0]; ?></span>
                                                </div>
                                                <?php endif?>
                                                <?php
                                                    if(is_array(get_post_meta(get_the_id(), 'contributor_location'))){
                                                        $tmp=get_the_terms(get_the_id(), 'github_contr_topothesia');
                                                        //error_log(var_dump(get_post_meta(get_the_id(), 'contributor_location')));
                                                    }
                                                    else{
                                                        $tmp=get_the_terms(get_the_id(), 'contributor_location');
                                                    }
                                                if(!empty($tmp)):
                                                ?>
                                                <div class='ellak-contributors contr-entry details-entry'>
                                                    <span class='ellak-contributors contr-entry details-label'>Location: </span>
                                                    <span class='ellak-contributors contr-entry details-value'><?php foreach($tmp as $tmp_term){echo $tmp_term->name.' ';} ?></span>
                                                </div>
                                                <?php endif?>
                                                <?php $tmp=get_post_meta(get_the_id(), 'contributor_github_url')[0];
                                                if(isset($tmp) && strcmp($tmp, '')):
                                                ?>
                                                <div class='ellak-contributors contr-entry details-entry'>
                                                    <span class='ellak-contributors contr-entry details-label'>Github page: </span>
                                                    <a href='<?php echo get_post_meta(get_the_id(), 'contributor_github_url')[0]; ?>' target="_blank" class="ellak-contributors contr-entry contributor-link">
                                                        <span class='ellak-contributors contr-entry details-value'><?php echo get_post_meta(get_the_id(), 'contributor_github_url')[0]; ?></span>
                                                    </a>
                                                </div>
                                                <?php endif?>
                                                <?php $tmp=get_the_terms(get_the_id(), 'github_contr_eteria');
                                                if(!empty($tmp)):
                                                ?>
                                                <div class='ellak-contributors contr-entry details-entry'>
                                                    <span class='ellak-contributors contr-entry details-label'>Company/organization: </span>
                                                    <span class='ellak-contributors contr-entry details-value'><?php foreach($tmp as $tmp_term){echo $tmp_term->name.' ';} ?></span>
                                                </div>
                                                <?php endif?>
                                                <?php $tmp=get_post_meta(get_the_id(), 'contributor_personal_webpage')[0];
                                                if(isset($tmp) && strcmp($tmp, '')):
                                                ?>
                                                <div class='ellak-contributors contr-entry details-entry'>
                                                    <span class='ellak-contributors contr-entry details-label'>Personal Webpage: </span>
                                                    <a href='<?php echo get_post_meta(get_the_id(), 'contributor_personal_webpage')[0]; ?>' target="_blank" class="ellak-contributors contr-entry contributor-link">
                                                        <span class='ellak-contributors contr-entry details-value'><?php echo get_post_meta(get_the_id(), 'contributor_personal_webpage')[0]; ?></span>
                                                    </a>
                                                </div>
                                                <?php endif?>
                                            </div>
                                        </div>
                                    </div> <!-- main-wrapper -->
                            <?php
                                endwhile;
                            endif;
                            ?>
                                    <div id="grey-backdrop" onclick="collapse_details_box()">
                                    </div>
                        </div>
                                <div class='ellak-contributors paging-buttons ellak-container'>
                                    <div class='ellak-contributors paging-buttons ellak-main-wrapper'>
                                        <div class='ellak-contributors paging-buttons ellak-button'>
                                        <?php echo paginate_links(); ?>
                                        </div>
                                    </div>
                                </div>
                        <div class="ellak-contributors data-info">This information has been retrieved from GitHub, using the GitHub api. The location names have been normalized for sorting purposes using the following scripts:</div>
                        <a class="ellak-contributors data-info repo-link" href='https://github.com/eellak/greek-commiters' target="_blank">github: retrieval scripts</a>
                        <a class="ellak-contributors data-info repo-link" href='https://github.com/eellak/greek-commiters_wp-plugins' target="_blank">github: presentational plugins</a>
                    </div><!-- inside-article -->           
                                    
			<?php do_action('generate_after_main_content'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer();
