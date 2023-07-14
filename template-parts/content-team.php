<?php
/**
 *
 *  Template part for displaying team members
 *
 *  @package IT_Residence
 *
 */
?>

 <article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-lg-4'); ?>>
     <?php
     //$agent = get_post( $agent );
     $agent_meta = get_post_meta(get_the_ID());
     $agent_thumb = get_the_post_thumbnail( NULL, 'itre_prop_thumb' );
     ?>

     <div class="itre-agent">
         <?php printf('<div class="agent-thumb">%s</div>', $agent_thumb); ?>

         <div class="itre-agent-info">
             <?php
             printf('<h3 class="agent-name">%s</h3>', get_the_title() );

             printf('<p class="agent-job">%s</p>', $agent_meta['designation'][0]);
             ?>

             <div class="agent-desc">
                 <?php itre_get_blog_excerpt(); ?>
             </div>

             <div class="agent-social">
                 <?php
                 printf('<a href="tel:%s"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-phone fa-stack-1x fa-inverse"></i></span></a>', $agent_meta['phone'][0]);

                 printf('<a href="mailto:%s"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></a>', $agent_meta['mail'][0]);
                 ?>
             </div>
         </div>
     </div>

 </article>
