<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM work_experience
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Work has been deleted');

  header('Location: work.php');
  die();
}

include('includes/header.php');

$query = 'SELECT *
  FROM work_experience
  ORDER BY "start_from"';
$result = mysqli_query($connect, $query);

?>

<h2>Manage Work Experience</h2>

<table>
  <tr>
    <th align="center">ID</th>
    <th align="left">Company</th>
    <th align="center">Title</th>
    <th align="center">Start</th>
    <th align="center">End</th>
    <th></th>
    <th></th>
  </tr>
  <?php while ($record = mysqli_fetch_assoc($result)) : ?>
    <tr>

      <td><?php echo $record['id']; ?></td>
      <td>
        <?php echo htmlentities($record['company_name']); ?>
      </td>
      <td><?php echo $record['job_title']; ?></td>
      <td><?php echo htmlentities($record['start_from']); ?></td>
      <td><?php echo htmlentities($record['end_to']); ?></td>
      <td align="center"><a href="work_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="work.php?delete=<?php echo $record['id']; ?>" onclick="return confirm('Are you sure you want to delete this Work Experience?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="work_add.php"><i class="fas fa-plus-square"></i> Add Work Experience</a></p>


<?php

include('includes/footer.php');

?>