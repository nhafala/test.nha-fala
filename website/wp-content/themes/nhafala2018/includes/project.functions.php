<?php

function projects_grid()
{
  $postsPerPage = -1;
  $posts = get_posts(
    array(
      "post_type" => "projects",
      "posts_per_page" => -1,
      "post_status" => "publish"
    )
  );
  ?>
<div class="projects-grid">
  <div class="row">
    <?php if (count($posts)) {
      foreach ($posts as $project) {
        project_item($project->ID);
      }
    }
    ?>
  </div>
</div>

<?php

}

function project_item($id)
{
  $url = get_permalink($id);
  $image = wp_get_attachment_image_src(get_post_thumbnail_id($id), "nhafala-project-thumbnail");
  $title = get_the_title($id);
  $excerpt = get_the_excerpt($id);
  ?>
  <div id="project-<?php print $id; ?>" class="project-item grid-layout-item col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="inner-wrap">
      <span class="cover"></span>
      <img src="<?php print $image[0] ?>" alt="<?php print $title; ?>" width="640" height="480">
      <!-- <div class="project-media" style="background-image: url(<?php print $image[0] ?>);"></div> -->
      <div class="project-content">
        <h3>
          <a href="<?php print $url; ?>" title="<?php print $title ?>" rel="bookmark"><?php print $title; ?></a>
        </h3>
        <p>Some stuff here<?php print $excerpt; ?></p>
        <a href="<?php print $url ?>" class="post-date">
          <span><?php print get_the_date("F Y", $id); ?></span>
        </a>
      </div>
    </div>
  </div>
  <?php

}
