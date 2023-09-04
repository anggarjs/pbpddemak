<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="card container mt-4 pt-3">
        <h4 class="card-title">Hasil Import RAB</h5>
            <?php
            $attributes     = array('class' => 'form-horizontal');
            echo form_open_multipart('Input/Upload_rab2', $attributes);
            ?>
            <table class="table table-striped table-bordered text-nowrap mt-3">
                <?php foreach ($excel_data as $row) : ?>
                    <tr>
                        <?php foreach ($row as $cell) : ?>
                            <td><?php echo $cell; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="text-end">
                <button type="submit" class="
								btn btn-info
								rounded-pill
								px-4
								waves-effect waves-light
								mb-3">
                    Save
                </button>
            </div>
            <?php echo form_close(); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>