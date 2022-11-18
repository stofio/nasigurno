<div class="single-share-box">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Deli na Facebook" class="">
        <svg class="h-6 w-6 mx-auto" fill="#7f848d" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                clip-rule="evenodd"></path>
        </svg>
    </a>
    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta( 'twitter' ); ?>"
        class="">
        <svg class="h-6 w-6 mx-auto" fill="#7f848d" viewBox="0 0 24 24" aria-hidden="true">
            <path
                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
            </path>
        </svg>
    </a>
    <a href="mailto:?subject=Pogledaj%20ovaj%20članak%20od%20<?php bloginfo('name'); ?>&body=<?php the_title(); ?> - <?php the_permalink(); ?>"
        class="" role="button" aria-label="Deli na Email">
        <svg class="h-6 w-6 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="#7f848d">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
            </path>
        </svg>
    </a>
</div>