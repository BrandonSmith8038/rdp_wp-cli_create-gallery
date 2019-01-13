<?php
/**
 * Plugin Name: Red Dirt Photography WP-CLI
 * Version: 0.1
 * Plugin URI: Red Dirt Photography
 * Description: Aids In Creating Galleries
 * Author: Brandon Smith
 * Text Domain: rdp-wpcli
 * Domain Path: /languages/
 * License: GPL v3
 */
if ( !defined( 'WP_CLI' ) && WP_CLI ) {
    //Then we don't want to load the plugin
    return;
}

class RDP_WP_CLI_COMMANDS extends WP_CLI_Command {

  function new_gallery(){
    $options = array(
      '1' => 'Buffalo Chip Jackpot',
      '2' => 'Buffalo Chip Practice',
      '3' => 'Barrel Racing'

    );
  
    $selected = cli\menu( $options, 'Enter A Number', 'What Type Of Gallery' );
    
    if ($selected === 1) {
      $this->buffalo_chip_jackpot();
    } else if ($selected === 2) {
      $this->buffalo_chip_practice();
    } else if ($selected === 3){
      $this->barrel_racing();
    }

  }

	function buffalo_chip_jackpot() {

    echo "\n";
    $parentTitle = cli\prompt( 'Enter The Title' );
    $parent_gallery='post create --post_title=' . $parentTitle . ' --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --porcelain';
  
    
    $options = array(
      'return'     => false,   // Return 'STDOUT'; use 'all' for full object.
    );
      echo "\n";
      WP_CLI::runcommand( $parent_gallery, $options );
      echo "\n";
      WP_CLI::success( 'Parent Post Added' );
      echo "\n";
      
      $parentID = cli\prompt( 'Enter The Parent ID' );
      $round1= 'post create --post_title="Round 1" --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --post_parent=' . $parentID;
      $round2= 'post create --post_title="Round 2" --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --post_parent=' . $parentID;
      $round3= 'post create --post_title="Round 3" --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --post_parent=' . $parentID;
      $kids= 'post create --post_title="Kids" --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --post_parent=' . $parentID;
      
      WP_CLI::runcommand( $kids, $options );
      WP_CLI::success( 'Kids Added' );
      echo "\n";
      WP_CLI::runcommand( $round3, $options );
      WP_CLI::success( 'Round 3 Added' );
      echo "\n";
      WP_CLI::runcommand( $round2, $options );
      WP_CLI::success( 'Round 2 Added' );
      echo "\n";
      WP_CLI::runcommand( $round1, $options );
      WP_CLI::success( 'Round 1' );
      echo "\n";


    }
    
    function buffalo_chip_practice() {


      $parentTitle = cli\prompt( 'Enter The Title' );
      $parent_gallery='post create --post_title=' . $parentTitle . ' --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --porcelain';
    
      
      $options = array(
        'return'     => false,   // Return 'STDOUT'; use 'all' for full object.
      );
        echo "\n";
        WP_CLI::runcommand( $parent_gallery, $options );
        echo "\n";
        WP_CLI::success( 'Parent Post Added' );
        echo "\n";
        
        $parentID = cli\prompt( 'Enter The Parent ID' );
        $round1= 'post create --post_title="Round 1" --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --post_parent=' . $parentID;
        $round2= 'post create --post_title="Round 2" --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --post_parent=' . $parentID;
        
        WP_CLI::runcommand( $round2, $options );
        WP_CLI::success( 'Round 2 Added' );
        echo "\n";
        WP_CLI::runcommand( $round1, $options );
        WP_CLI::success( 'Round 1' );
        echo "\n";
  
  
      }

      function barrel_racing(){

          
        $options = array(
          'return' => false,   // Return 'STDOUT'; use 'all' for full object.
        );

        $parentTitle = cli\prompt( 'Enter Title' );
        $numRiders = cli\prompt( 'Enter Number Of Riders ' );

        $parent_gallery='post create --post_title=' . $parentTitle . ' --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --porcelain';
        
        echo "\n";
        WP_CLI::runcommand( $parent_gallery, $options );
        echo "\n";
        WP_CLI::success( 'Parent Post Added' );
        echo "\n";
        $parentID = cli\prompt( 'Enter The Parent ID' );
        echo "\n";
        
        for ( $i = 1; $i <= $numRiders; $i += 5 ){
          $title = 'Riders ' . $i . '-' . ($i + 4);
          echo "\n";
          $riderFolder= 'post create --post_title="' . $title . '" --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --post_parent=' . $parentID;
          WP_CLI::runcommand( $riderFolder, $options );
          WP_CLI::success( $title . ' Added' );
          echo "\n";
        }
        
        $peeWees = cli\prompt( 'Create PeeWees Folder' );
        
        if( $peeWees === 'y' || $peeWees ==='Y' ){
          $peeWeeGallery= 'post create --post_title="PeeWees" --post_content=" " --post_excerpt=" " --post_type="sunshine-gallery" --post_parent=' . $parentID;
          WP_CLI::runcommand( $peeWeeGallery, $options );
          WP_CLI::success( 'PeeWees Added' );
          echo "\n";
        }
      }

}

WP_CLI::add_command( 'create', 'RDP_WP_CLI_COMMANDS' );