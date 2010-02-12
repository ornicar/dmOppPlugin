<?php

class dmOppAdminActions extends dmAdminBaseActions
{

  public function executeIndex(dmWebRequest $request)
  {
  }

  public function executeBackupImages(dmWebRequest $request)
  {
    $webDir = sfConfig::get('sf_web_dir');
    $backupFileName = dmString::slugify(dmConfig::get('site_name')).'_images_'.date("Y-m-d-H-i-s").'.tgz';

    try
    {
      $command = "cd $webDir && tar -czf $backupFileName uploads/*";

      if(!$this->getService('filesystem')->exec($command))
      {
        throw new dmException('Cannot run '.$command);
      }
    }
    catch(Exception $e)
    {
      $this->getUser()->logError('La sauvegarde a échoué.');
      return $this->redirectBack();
    }

    return $this->redirect('/'.$backupFileName);
  }

//  public function executeBackupImages(dmWebRequest $request)
//  {
//    $imagesDir = sfConfig::get('sf_upload_dir').'/photo';
//    $backupDir = sfConfig::get('sf_cache_dir').'/backupImages';
//    $backupPublicDir = sfConfig::get('sf_web_dir').'/cache';
//    $backupPublicFile = dmString::slugify(dmConfig::get('site_name')).'_images_'.date("Y-m-d-H-i-s").'.tgz';
//
//    $filesystem = $this->getService('filesystem');
//    $filesystem->mkdir($backupDir);
//    $filesystem->deleteDirContent($backupDir);
//
//    try
//    {
//      foreach($filesystem->find('file')->maxDepth(0)->in($imagesDir) as $image)
//      {
//        $backupImage = $backupDir.'/'.basename($image);
//
//        if(!copy($image, $backupImage))
//        {
//          throw new dmException(sprintf('Cannot copy %s to %s', $image, $backupImage));
//        }
//      }
//
//      $command = "cd $backupPublicDir && tar -czf $backupPublicFile $backupDir";
//
//      if(!$filesystem->exec($command))
//      {
//        throw new dmException('Cannot run '.$command);
//      }
//    }
//    catch(Exception $e)
//    {
//      $this->getUser()->logError('La sauvegarde a échoué.');
//      return $this->redirectBack();
//    }
//
//    return $this->redirect('/cache/'.$backupPublicFile);
//  }

  /*
   * ZipArchive ne supporte pas les noms de fichiers en UTF-8 :-/
   */
//  public function executeBackupImages(dmWebRequest $request)
//  {
//    $imagesDir = sfConfig::get('sf_upload_dir').'/photo';
//    $backupFile = sfConfig::get('sf_web_dir').'/cache/'.dmString::slugify(dmConfig::get('site_name')).'_images_'.date("Y-m-d-H-i-s").'.zip';
//
//    try
//    {
//      $zip = new ZipArchive();
//
//      if (true !== $zip->open($backupFile, ZIPARCHIVE::CREATE))
//      {
//        throw new dmException(sprintf('Cannot create %s', $backupFile));
//      }
//
//      foreach($this->getService('filesystem')->find('file')->maxDepth(0)->in($imagesDir) as $image)
//      {
//        $zip->addFile($image, basename($image));
//      }
//
//      $zip->close();
//    }
//    catch(Exception $e)
//    {
//      $this->getUser()->logError('La sauvegarde a échoué.');
//      return $this->redirectBack();
//    }
//
//    return $this->redirect('/cache/'.basename($backupFile));
//  }

  public function executeBackupMysql(dmWebRequest $request)
  {
    $backupFile = sfConfig::get('sf_cache_dir').'/'.dmString::slugify(dmConfig::get('site_name')).'_mysql_'.date("Y-m-d-H-i-s").'.sql.gz';
    
    $connection = dmDb::table('Photo')->getConnection();
    
    $user = $connection->getOption('username');
    $pass = $connection->getOption('password');
    $host = preg_replace('/mysql\:host=([-\w]+);.*/i', '$1', $connection->getOption('dsn'));
    $name = preg_replace('/mysql\:host=[-\w]+;dbname=([-\w]+);.*/i', '$1', $connection->getOption('dsn'));

    $command = "mysqldump --opt -h $host -u $user -p$pass $name | gzip > $backupFile";
    
    if(!$this->getService('filesystem')->execute($command))
    {
      $this->getUser()->logError('La sauvegarde a échoué.');
      return $this->redirectBack();
    }
    else
    {
      return $this->download($backupFile);
    }
  }

}