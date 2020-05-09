<?php

// /assets/migrate/seeds/fairies.php

return array(
    array(
        'id'   => 1,
        'name' => 'Pixie'
    ),
    array(
        'id'   => 2,
        'name' => 'Trixie'
    ),
);

// /assets/migrate/seeds/flowers.json

[
    {
        "id": 1,
        "name": "daisy"
    },
    {
        "id": 2,
        "name": "Rose"
    },
]

?>
<?php
// /assets/migrate/seeds/fairies.php

$this->connection()->insertQuery()
    ->data([
        'id'   => 1,
        'name' => 'Pixie'
     ])
     ->execute();