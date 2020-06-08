<?php

namespace Drupal\test_module\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "test_module_example_block",
 *   admin_label = @Translation("Test Module Custom Block"),
 * )
 */
class CustomBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $heading = '<h2>' . $config['heading'] . '</h2>';
    $copy = '<div class="copy-block">' . $config['copy'] . '</div>';
    return [
      '#markup' => $heading . $copy,
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    $form['heading'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Heading'),
      '#required' => TRUE,
      '#default_value' => $config['heading'],
    ];
    $form['copy'] = [
      '#type' => 'text_format',
      '#format'=> 'full_html',
      '#title' => $this->t('Copy'),
      '#required' => TRUE,
      '#default_value' => $config['copy'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['heading'] = $form_state->getValue('heading');
    $this->configuration['copy'] = $form_state->getValue('copy');
  }
}
