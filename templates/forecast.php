<style>
    <?php include('alpinefx.css'); ?>
</style>

<div class="alpinefx">
    <?php
    $fc = $this->get_forecasts();

    if( $fc )
    {
    ?>
    <table class="alpinefx-forecasts">
        <tbody>
        <tr>
            <?php
            foreach( $fc->{'forecast'} as $forecast )
            {
                require('forecast.entry.php');
            }
            ?>
        </tr>
        </tbody>
    </table>
    <p class="alpinefx-meta">
        <?php
        printf(
            '<span class="alpinefx-location">Forecast for %s</span>',
            $this->get_location()
        );
        ?>
        &bull;
        <?php echo $this->get_created_time(); ?> (<?php echo $this->get_next_time(); ?>)
    </p>

    <?php
    }
    else
    {
        $this->display_error('Sorry, we could not find the forecast for '. $this->get_location() );
    }
    ?>
</div>