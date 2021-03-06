<?php
/* ----- получить категории -----*/
function getProductCategories($db) {
    $sql = "
    SELECT * FROM `category`;";
    $result = $db->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data;
};

/* ----- Получить список активных лотов ----- */
function getActiveProducts($db) {
    $sql = "
    SELECT lots.name, lots.price, lots.img AS `url`, lots.description, lots.id,
    category.name AS `category`, lots.date_expire AS `date_expire`,
    IFNULL(MAX(bid.amount), lots.price) AS `current_price`,
    lots.date_register, lots.bid_step
    FROM lots
    JOIN category ON lots.category_id=category.id
    LEFT OUTER JOIN bid ON lots.id=bid.lot_id
    WHERE winner_user_id IS NULL
    GROUP BY lots.name, lots.price, lots.img, category.name, lots.date_register, lots.date_expire, lots.bid_step, lots.description, lots.id
    ORDER BY lots.date_register DESC;
    ";
    $result = $db->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
};

/* ----- Получить данные об одном лоте ----- */
function getProductData($product_id, $db) {
    $sql = "
    SELECT lots.name, lots.price, lots.img AS `url`, lots.description,
    category.name AS `category_name`, category.title AS `category_title`, lots.date_expire AS `date_expire`,
    IFNULL(MAX(bid.amount), lots.price) AS `current_price`,
    lots.date_register, lots.bid_step
    FROM lots
    JOIN category ON lots.category_id=category.id
    LEFT OUTER JOIN bid ON lots.id=bid.lot_id
    WHERE lots.id=?
    GROUP BY lots.name, lots.price, lots.img, lots.description, lots.date_register, lots.date_expire, category.name, category.title, lots.bid_step;
    ";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data;
};

/* ----- получить список всех ставок по одному лоту  ----- */
function getProductBids($product_id, $db) {
    $sql = "
    SELECT bid.amount, bid.date_register, users.name AS `bid_user_name`
    FROM bid
    JOIN users ON bid.user_id=users.id
    WHERE bid.lot_id=? ORDER BY date_register DESC;
    ";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
};

/* ----- Отправить данные о лоте в БД  ----- */
function insertNewProduct($name, $description, $img, $date_expire, $price, $bid_step, $category_id, $author_user_id, $db) {
    $sql = "
    INSERT INTO lots (name, description, img, date_expire, price, bid_step, category_id, author_user_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?);
    ";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssdiii", $name, $description, $img, $date_expire, $price, $bid_step, $category_id, $author_user_id);
    $stmt->execute();
    $id = $db->insert_id;
    return $id;
};
