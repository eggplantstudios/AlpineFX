<td>
    <table class="alpinefx-forecast">
    <?php

    // Period
    printf('<tr><th class="alpinefx-period alpinefx-table-heading">%s</th></tr>',
        $forecast->period
    );

    // Icon
    printf('<tr><td class="alpinefx-icon">%s</td></tr>',
        $this->get_icon( $forecast )
    );



    // Temps
    printf('<tr><td class="alpinefx-summary">%s</td></tr>',
        $forecast->textSummary
    );

    // Summary
    printf('<tr><td class="alpinefx-temperatures">%s</td></tr>',
        $this->format_temperatures( $forecast->temperatures->temperature )
    );

    // precipitation
    printf('<tr><th>Precipitation</th></tr>');
    printf('<tr><td class="alpinefx-precipitation">%s</td></tr>',
        $forecast->precipitation->textSummary
    );

    // wind
    printf('<tr><th>Wind</th></tr>');
    printf('<tr><td class="alpinefx-wind">%s</td></tr>',
        $forecast->wind->textSummary
    );

    // freezingLevel
    printf('<tr><th>Freezing</th></tr>');
    printf('<tr><td class="alpinefx-freezinglevel">%s</td></tr>',
        $forecast->freezingLevel->textSummary
    );
    ?>
    </table>
</td>