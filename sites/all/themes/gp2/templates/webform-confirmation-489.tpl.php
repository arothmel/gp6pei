<?php

/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * This file may be renamed "webform-confirmation-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-confirmation.tpl.php" to affect all webform confirmations on your
 * site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $confirmation_message: The confirmation message input by the webform author.
 * - $sid: The unique submission ID of this submission.
 */
?>

<div class="webform-confirmation">
  <?php if ($confirmation_message): ?>
    <?php print $confirmation_message ?>
  <?php else: ?>
    <p><?php print t('Thank you, your submission has been received.'); ?><br />

  <ul>
    <li><a href="<?php print url('node/'. $node->nid . '/submission/'. $sid)?>">View your submission</a></li>
    <li><a href="<?php print url('node/'. $node->nid . '/submission/'. $sid .'/edit')?>">Edit your submission</a></li>


  </ul>
<?php include_once(drupal_get_path('module', 'webform') .'/includes/webform.submissions.inc');
$nid = 489; // need to hard-code nid if this is a custom page
$sid = $_GET['sid']; $submission = webform_get_submission($nid, $sid);
$name_of_student = $submission->data[1]['value'][0];
$thanks = $name_of_student;
$trial_class_cost = $submission->data[9]['value'][0];
$total_to_pay = $trial_class_cost; ?>

<h2> Thank you <?php print $thanks ?> for submitting your registration.</h2>
</p>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print url('node/'. $node->nid) ?>"><?php print t('Go back to the form') ?></a>
</div>
