<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * tweet actions.
 *
 * @package    OpenPNE
 * @subpackage tweet
 * @author     hiroya (hiroyaxxx@gmail.com)
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class opTweetTestPluginTweetActions extends sfActions
{
  public function configure()
  {
    $DS = DIRECTORY_SEPARATOR;
    $pluginName = 'opTweetTestPlugin';
    $vendorPath = sfConfig::get('sf_plugins_dir').$DS.$pluginName.$DS.'lib'.$DS.'vendor';
    require_once($vendorPath.'/twitterOAuth.php');
  }

  public function executeTweetPost(sfWebRequest $request)
  {
    $twStatus = $request->getParameter('status');
    if (mb_strlen($twStatus) < 1)
    {
      return sfView::HEADER_ONLY;
    }

    $authAdapter = new opAuthAdapterWithTwitter('WithTwitter');
    $consumerKey = $authAdapter->getAuthConfig('awt_consumer');
    $consumerSecret = $authAdapter->getAuthConfig('awt_secret');

    $member = $this->getUser()->getMember();
    $oauthToken = $member->getConfig('twitter_oauth_token');
    $oauthTokenSecret = $member->getConfig('twitter_oauth_token_secret');

    $con = new TwitterOAuth($consumerKey, $consumerSecret, $oauthToken, $oauthTokenSecret);
    if($con)
    {
      $rst = $con->post('statuses/update', array('status' => $twStatus));
      echo json_encode($rst);
    }

    return sfView::HEADER_ONLY;
  }
}