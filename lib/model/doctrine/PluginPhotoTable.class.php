<?php
/**
 */
class PluginPhotoTable extends myDoctrineTable
{
  
  /**
   * @return dmDoctrine query
   * the default admin list query
   */
  public function getAdminListQuery(dmDoctrineQuery $query)
  {
    return $query
    ->withDmMedia('Image', 'r')
    ->leftJoin('r.Thematiques thematiques')
    ->leftJoin('r.Site site')
    ->leftJoin('r.CreatedBy createdBy')
    ->leftJoin('r.UpdatedBy updatedBy')
    ->select('r.*, rImage.*, rImageFolder.rel_path, thematiques.*, site.*, createdBy.username, updatedBy.username');
  }
}