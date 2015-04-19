<?php
/**
 * Created by PhpStorm.
 * User: shawnwernig
 * Date: 15-04-19
 * Time: 11:05 AM
 */

class AlpineFX
{
    private $data;
    private $endpoint = "https://alpinefx.rwdi.com/content/v2/xml/";
    private $icon_endpoint = "https://alpinefx.rwdi.com/images/wx_icons/";
    private $icon_format = "gif";

    public function __construct( $resource )
    {
        $uri = $this->build_resource_uri( $resource );
        try
        {
            if( $this->resource_exists( $uri ) )
            {
                $this->data = simplexml_load_file( $uri );
            }
            else
            {
                throw new Exception("ERROR: $uri does not exist.");
            }
        }
        catch ( Exception $e )
        {
            $this->display_error( $e->getMessage() );
            die();
        }
    }

    public function set_icon_endpoint( $endpoint )
    {
        $this->icon_endpoint = $endpoint;
    }
    public function set_icon_format( $icon_format )
    {
        $this->icon_format = $icon_format;
    }
    private function build_resource_uri( $resource )
    {
        return sprintf("%s%s.xml",
            $this->endpoint,
            $resource
        );
    }

    private function get_http_response_code($uri) {
        $headers = get_headers($uri);
        return substr($headers[0], 9, 3);
    }


    private function resource_exists( $uri )
    {
        $h = $this->get_http_response_code( $uri );
        return ( '404' == $h ) ? false : true;
    }


    public function get_forecasts()
    {
        return $this->data->forecasts;
    }
    public function display()
    {
        require('templates/forecast.php');
    }

    private function get_location()
    {
        return $this->data->location;
    }
    private function get_created_time()
    {
        return sprintf(
            '<span class="alpinefx-created">Created %s</span>',
            $this->data->dateTime[1]->textSummary
        );
    }
    private function get_next_time()
    {
        return sprintf(
            '<span class="alpinefx-next">%s</span>',
            $this->data->dateTime[2]->textSummary
        );
    }

    public function format_temperatures( SimpleXMLElement $temperatures )
    {
        if( count( $temperatures ) >= 2 )
        {
            return sprintf('High: <strong>%s</strong> <br> Low: <strong>%s</strong>',
                $this->format_temperature( (string) $temperatures[0], $temperatures->attributes()->unitType ),
                $this->format_temperature( (string) $temperatures[1], $temperatures->attributes()->unitType )
            );
        }
        else
        {
            return sprintf('<strong>%s</strong>',
                $this->format_temperature( (string) $temperatures, $temperatures->attributes()->unitType )
            );
        }
    }

    private function format_temperature( $value, $unit )
    {
        switch( strtolower($unit) )
        {
            case 'f':
            case 'fahrenheit':
                return sprintf('%s&deg;F', ($value * 33.8) );
                break;
            case 'c':
            case 'celsius':
            case 'metric':
            default:
                return sprintf('%s&deg;C', $value );
                break;

        }
    }

    private function get_icon( SimpleXMLElement $forecast )
    {
        return sprintf( '<img src="%s" alt="%s">',
            $this->get_icon_url( $forecast->iconCode ),
            $forecast->textSummary
        );
    }

    private function get_icon_url( $id )
    {
        return $this->icon_endpoint . $id . '.' . $this->icon_format;
    }

    public function display_error( $string )
    {
        printf('<p class="aplinefx-error">%s</p>', $string );
    }



}