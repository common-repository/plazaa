<ul>
    <?php foreach ($ratings as $item) { ?>
        <li>
            <a title="Mein Bericht zu <?php echo $item['locationName']; ?>" href="<?php echo $item['locationUrl'] . $item['commentUrl']; ?>">
                <?php echo $item['locationName']; ?>
            </a><br />
            <img src="<?php echo plugins_url('img/stars-' . $item['rating'] . '.png', dirname(__FILE__)); ?>" alt="<?php echo $item['rating']; ?>/5">
        </li>
    <?php } ?>
    <li class="plazaa-more"><a href="<?php echo $item['profileUrl'] ?>">Alle Bewertungen anzeigen</a></li>
</ul>