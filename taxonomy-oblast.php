<?php

$term = get_term_by('slug', get_query_var('term'), 'oblast');
if((int)$term->parent)
    get_template_part('taxtmp', 'ochild');
else
    get_template_part('taxtmp', 'oparent');

?>