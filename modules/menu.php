<nav class="mainMenu">
    <ul>
        <?php
            foreach($menu as $polozka) {
                ?>
                    <li>
                        <a href="<?php echo $polozka['link']; ?>" title="<?php echo $polozka['tooltip']; ?>">
                            <?php echo $polozka['name']; ?>
                        </a>
                    </li>
                <?php
            }
        ?>
    </ul>
</nav>