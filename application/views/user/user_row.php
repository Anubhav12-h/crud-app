<tr id="row-<?php echo $row['id']; ?>">
<td class="modelId"><?php echo $row['id']; ?></td>
<td class="modelName"><?php echo $row['name']; ?></td>
<td class="modelEmail"><?php echo $row['email']; ?></td>
<td class="modelDesign"><?php echo $row['design']; ?></td>
<td class="modelSalary"><?php echo $row['salary']; ?></td>
<td class="modelDate"><?php echo $row['date']; ?></td>
<td><a href="#" class="btn btn-primary" onclick="showEditForm(<?php echo $row['id']; ?>);">Edit</a></td>
<td><a href="#" class="btn btn-danger" onclick="confirmDeleteModel(<?php echo $row['id']; ?>);">Delete</a></td>
</tr>