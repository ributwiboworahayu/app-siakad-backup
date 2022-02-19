<thead>
    <tr>
        <th scope="col" rowspan="2" class="align-middle">NAMA DOSEN</th>
        <th scope="col" rowspan="2" class="align-middle">MATA KULIAH</th>
        <th scope="col" rowspan="2" class="align-middle">SEMESTER</th>
        <th scope="col" colspan="2" class="text-center">SKS</th>
        <th scope="col" colspan="2" class="text-center">JAM</th>
    </tr>
    <tr>
        <th scope="col" class="text-center">TEORI</th>
        <th scope="col" class="text-center">PRAKTEK</th>
        <th scope="col" class="text-center">TEORI</th>
        <th scope="col" class="text-center">PRAKTEK</th>
    </tr>
</thead>
<?php if ($data11 > 0) : ?>
    <?php foreach ($data1 as $dt1) : ?>
        <?php
        $countmk = set_tdist($dt1->dosen_id)
        ?>
        <tbody>
            <?php
            $tjamteori = 0;
            $tjampraktek = 0;
            ?>
            <?php foreach ($countmk->result() as $cnt => $val) : ?>
                <tr>
                    <?php if ($cnt == 0) : ?>
                        <td rowspan="<?= $countmk->num_rows() ?>" id="td-align">
                            <?= $dt1->nama_dsn; ?>
                        </td>
                    <?php endif ?>
                    <td><?= $val->matkul . ' ' . $val->nama_kelas ?></td>
                    <td class="text-center"><?= $val->semester_id ?></td>
                    <td class="text-center"><?= $val->teori ?></td>
                    <td class="text-center"><?= $val->praktek ?></td>
                    <td class="text-center"><?= $jamteori = $val->teori * 15 ?></td>
                    <td class="text-center"><?= $jampraktek = $val->praktek * 30 ?></td>

                </tr>
                <?php
                $tjamteori += $jamteori;
                $tjampraktek += $jampraktek;
                ?>
            <?php endforeach ?>
            <?php
            $totalt = set_sumtdist($dt1->dosen_id);
            ?>
            <tr>
                <td colspan="3" class="">Total</td>
                <td class="text-center"><?= $totalt->t ?></td>
                <td class="text-center"><?= $totalt->p ?></td>
                <td class="text-center"><?= $tjamteori ?></td>
                <td class="text-center"><?= $tjampraktek ?></td>
            </tr>
            <tr>
                <td colspan="5" class="">Total Jam</td>
                <td colspan="2" class="text-center"><?= $tjamteori + $tjampraktek ?></td>
            </tr>
        </tbody>
        <tbody class="bg-light">
            <tr>
                <td colspan="9"></td>
            </tr>
        </tbody>
    <?php endforeach; ?>
<?php else : ?>
    <tbody>
        <tr>
            <td colspan="9" class="text-center"><br>Belum ada data disini!<br><br></td>
        </tr>
    </tbody>
<?php endif ?>