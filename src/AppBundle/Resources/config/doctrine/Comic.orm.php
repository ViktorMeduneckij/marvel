<?php

use Doctrine\ORM\Mapping\ClassMetadataInfo;

$metadata->setInheritanceType(ClassMetadataInfo::INHERITANCE_TYPE_NONE);
$metadata->customRepositoryClassName = 'AppBundle\Repository\ComicRepository';
$metadata->setChangeTrackingPolicy(ClassMetadataInfo::CHANGETRACKING_DEFERRED_IMPLICIT);
$metadata->mapField(array(
   'fieldName' => 'id',
   'type' => 'integer',
   'id' => true,
   'columnName' => 'id',
  ));
$metadata->mapField(array(
   'columnName' => 'title',
   'fieldName' => 'title',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'comicId',
   'fieldName' => 'comicId',
   'type' => 'integer',
  ));
$metadata->mapField(array(
   'columnName' => 'description',
   'fieldName' => 'description',
   'type' => 'text',
  ));
$metadata->mapField(array(
   'columnName' => 'pageCount',
   'fieldName' => 'pageCount',
   'type' => 'integer',
  ));
$metadata->mapField(array(
   'columnName' => 'coverPath',
   'fieldName' => 'coverPath',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'coverExtension',
   'fieldName' => 'coverExtension',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'creators',
   'fieldName' => 'creators',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'characters',
   'fieldName' => 'characters',
   'type' => 'array',
  ));
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);