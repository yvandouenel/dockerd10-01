<?php declare(strict_types = 1);

namespace Drupal\library_books\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Library books type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "library_books_type",
 *   label = @Translation("Library books type"),
 *   label_collection = @Translation("Library books types"),
 *   label_singular = @Translation("library books type"),
 *   label_plural = @Translation("library bookss types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count library bookss type",
 *     plural = "@count library bookss types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\library_books\Form\LibraryBooksTypeForm",
 *       "edit" = "Drupal\library_books\Form\LibraryBooksTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\library_books\LibraryBooksTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer library_books types",
 *   bundle_of = "library_books",
 *   config_prefix = "library_books_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/library_books_types/add",
 *     "edit-form" = "/admin/structure/library_books_types/manage/{library_books_type}",
 *     "delete-form" = "/admin/structure/library_books_types/manage/{library_books_type}/delete",
 *     "collection" = "/admin/structure/library_books_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class LibraryBooksType extends ConfigEntityBundleBase {

  /**
   * The machine name of this library books type.
   */
  protected string $id;

  /**
   * The human-readable name of the library books type.
   */
  protected string $label;

}
