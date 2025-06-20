<?php
/**
 * Base template which includes header and footer.
 * Expected variables: $page_title and $content
 */
require __DIR__ . '/../partials/header.php';
?>
<?php echo $content; ?>
<?php
require __DIR__ . '/../partials/footer.php';
