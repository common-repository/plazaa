<ul>
    <li class="plazaa-zahlen-profil">
        <a rel="me" title="Profil von <?php echo $profile['userName']; ?>" href="http://plazaa.de/profil/<?php echo $profile['userName']; ?>/">
            <span>
                <img alt="avatar" src="<?php echo $profile['avatarUrl']; ?>">
            </span>
            <?php echo $profile['userName']; ?>
        </a>
    </li>
	<li class="plazaa-zahlen-empfehlungen">
	    <a rel="nofollow" href="http://plazaa.de/profil/<?php echo $profile['userName']; ?>/">
	        <span><?php echo $profile['numRatings']; ?></span>Empfehlungen
	    </a>
	</li>
	<li class="plazaa-zahlen-fotos">
	    <a rel="nofollow" href="http://plazaa.de/profil/<?php echo $profile['userName']; ?>/meine-fotos/">
	        <span><?php echo $profile['numPics']; ?></span>Fotos
	    </a>
	</li>
	<li class="plazaa-zahlen-freunde">
	    <a rel="nofollow" href="http://plazaa.de/profil/<?php echo $profile['userName']; ?>/freunde/">
	        <span><?php echo $profile['numFriends']; ?></span>Freunde
	    </a>
	</li>
</ul>