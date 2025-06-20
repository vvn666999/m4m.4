<?php
/**
 * Base template which includes header and footer.
 * Expected variables: $page_title and $content
 */
require_once __DIR__ . '/../cfg/env.php';
require __DIR__ . '/../partials/header.php';
?>
<?php echo $content; ?>
<?php
require __DIR__ . '/../partials/footer.php';
