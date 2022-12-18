<footer class="page-footer" id="footer" <?php if ($unlisted == 1) {echo 'style="background-color: rgba(255, 69, 0, .5) !important;"'; } ?>>
	<div class="container center" style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;color: white;">
      <?php if ($unlisted == 1) {echo '<p style="color: white;">Warning: This page is unlisted. Please share wisely. That&#39;s what Dum Dik would do.</p>'; } ?>
	  The messages expressed above are not representative of the opinions of Dum Dik or his staff. <?php
if (isset($views)) {
    echo "Page Views: $views";
}
?>
      </div>
 </footer>

