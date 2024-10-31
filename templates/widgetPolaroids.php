<ul class="polaroids">
    <?php foreach ($ratings as $item) { ?>
        <li class="polaroid">
            <a class="pola" title="Bericht zu <?php echo $item['locationName']; ?>" href="<?php echo $item['locationUrl'] . $item['commentUrl']; ?>">
                <img alt="<?php echo $item['locationName']; ?> Bild" height="110" width="160" src="<?php echo $item['thumbUrl']; ?>">
                <?php echo $item['locationName']; ?>
                <img class="bewertung" src="<?php echo plugins_url('img/stars-' . $item['rating'] . '.png', dirname(__FILE__)); ?>" alt="<?php echo $item['rating']; ?>/5">
            </a>
        </li>
    <?php } ?>
</ul>
<br class="plazaa-clear">