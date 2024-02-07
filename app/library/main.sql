-- prefectures_app

-- 都道府県テーブル
-- 都道府県テーブルテーブルは、一度不要。
-- CREATE TABLE prefectures (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL
-- );

-- 訪問記録テーブル
CREATE TABLE visit_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prefecture VARCHAR(255),
    region VARCHAR(255),
    stay_level VARCHAR(255),
    visit_date DATE,
    purpose VARCHAR(255)
    --FOREIGN KEY (prefecture_id) REFERENCES Prefectures(id),
    --FOREIGN KEY (stay_level_id) REFERENCES StayLevels(id)
);

-- ステイレベルテーブルは、一度不要。
-- ステイレベルは固定でいく。データで管理はしないようにまずは作成する。
-- ステイレベルテーブル
-- CREATE TABLE stayLevels (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     level_name VARCHAR(20) NOT NULL
-- );
