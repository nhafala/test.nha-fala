<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php $show_date_array = array(
    'post',
    'projects'
  );
  ?>

	<header class="entry-header">

    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    <?php if (in_array(get_post_type(), $show_date_array)) : ?>
    <span class="entry-meta">
      <?php print nhafala_time_link() ?>
    </span>
    <?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ('' !== get_the_post_thumbnail()) : ?>
		<div class="entry-thumbnail">
				<?php the_post_thumbnail('nhafala-post-banner'); ?>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
        <span id="event-category">
            <?php
            $categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ','' );
            $categories_list = explode(",", $categories_list);
            $count = count($categories_list);
            $i = 1;
            if($count == 1){ ?>
                    Kategorie:
                    <?php
                        foreach($categories_list as $category){
                            if($i == $count){
                                echo $category;
                            }else{
                                echo $category.", ";
                            }
                            $i++;
                        }
            }elseif($count > 1){?>
                    Kategorien:
                    <?php
                        foreach($categories_list as $category){
                            if($i == $count){
                                echo $category;
                            }else{
                                echo $category.", ";
                            }
                            $i++;
                        }
            }

    //        var_dump($categories_list);
            ?>
        </span>
    <?php the_content(); ?>

    <?php
    wp_link_pages(
      array(
        'before' => '<div class="page-links">' . __('Pages:', 'nhafala'),
        'after' => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after' => '</span>',
      )
    );
    ?>

    <?php nhafala_social_likes() ?>

  </div><!-- .entry-content -->

</article><!-- #post-## -->
