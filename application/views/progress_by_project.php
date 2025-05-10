<h3>Progress for All Phases in Project</h3>

<?php foreach ($progressData as $item): ?>
    <h4>Phase: <?= $item['phase']->phaseName ?></h4>
    <?php if (!empty($item['activities'])): ?>
        <ul>
            <?php foreach ($item['activities'] as $activity): ?>
                <li><?= $activity->activityType ?> - <?= $activity->activityName ?> (<?= $activity->recordDate ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No activities recorded for this phase.</p>
    <?php endif; ?>
<?php endforeach; ?>
