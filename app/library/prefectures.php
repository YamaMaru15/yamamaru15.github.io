<?php
declare(strict_types=1);

class Prefectures
{
    /**
     * 記録番号をキーに都道府県記録が存在するか判定する
     *
     * @param string $id 記録番号
     * @return bool true:存在する／false:存在しない
     */
    public static function isExists(string $id): bool
    {
        $sql = "SELECT COUNT(*) AS count FROM visit_records WHERE id = :id";
        $param = ["id" => $id];
        $count = DataBase::fetch($sql, $param);
        if ($count["count"] >= 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 社員番号をキーに社員情報を取得する
     *
     * @param string $id 社員番号
     * @return array SQL実行結果配列
     */
    public static function getById(string $id): array
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $param = ["id" => $id];
        return DataBase::fetch($sql, $param);
    }

    /**
     * 記録番号をキーに都道府県記録を削除する
     *
     * @param string $id 記録番号
     * @return bool SQL実行結果
     */
    public static function deleteById(string $id): bool
    {
        $sql = "DELETE FROM visit_records` WHERE id = :id";
        $param = ["id" => $id];
        return DataBase::execute($sql, $param);
    }

    /**
     * 検索条件にヒットした記録件数を取得する
     *
     * @param string $prefecture 都道府県
     * @param string $region 地方
     * @param string $stay_level 滞在レベル
     * @param string $visit_date 訪問日
     * @return string SQL実行結果
     */
    public static function searchCount(
        string $prefecture, string $region, string $stay_level, string $visit_date
    ): string | int
    {
        list($whereSql, $param) =
            self::getSearchWhereSqlAndParam($prefecture, $region, $stay_level, $visit_date);
        $sql = "SELECT COUNT(*) AS count FROM visit_records WHERE 1 = 1 {$whereSql}";
        $count = DataBase::fetch($sql, $param);
        return $count["count"];
    }

    /**
     * 検索条件にヒットした記録情報を取得する
     *
     * @param string $prefecture 都道府県
     * @param string $region 地方
     * @param string $stay_level 滞在レベル
     * @param string $visit_date 訪問日
     * @return array SQL実行結果
     */
    public static function searchData(
        string $prefecture, string $region, string $stay_level, string $visit_date
    ): array
    {
        list($whereSql, $param) = 
            self::getSearchWhereSqlAndParam($prefecture, $region, $stay_level, $visit_date);
        $sql = "SELECT * FROM visit_records WHERE 1 = 1 {$whereSql} ORDER BY visit_date";
        return DataBase::fetchAll($sql, $param);
    }

    /**
     * 社員情報を登録する
     *
     * @param string $id 社員番号
     * @param string $name 氏名
     * @param string $nameKana 氏名カナ
     * @param string $birthday 誕生日
     * @param string $gender 性別
     * @param string $organization 部署
     * @param string $post 役職
     * @param string $startDate 入社年月日
     * @param string $tel 電話番号
     * @param string $mailAddress メールアドレス
     * @return bool SQL実行結果
     */
    public static function insert(
        string $id,
        string $name,
        string $nameKana,
        string $birthday,
        string $gender,
        string $organization,
        string $post,
        string $startDate,
        string $tel,
        string $mailAddress
    ): bool {
        $sql  = "INSERT INTO users ( ";
        $sql .= "  id, ";
        $sql .= "  name, ";
        $sql .= "  name_kana, ";
        $sql .= "  birthday, ";
        $sql .= "  gender, ";
        $sql .= "  organization, ";
        $sql .= "  post, ";
        $sql .= "  start_date, ";
        $sql .= "  tel, ";
        $sql .= "  mail_address, ";
        $sql .= "  created, ";
        $sql .= "  updated ";
        $sql .= ") VALUES (";
        $sql .= "  :id, ";
        $sql .= "  :name, ";
        $sql .= "  :name_kana, ";
        $sql .= "  :birthday, ";
        $sql .= "  :gender, ";
        $sql .= "  :organization, ";
        $sql .= "  :post, ";
        $sql .= "  :start_date, ";
        $sql .= "  :tel, ";
        $sql .= "  :mail_address, ";
        $sql .= "  NOW(), "; //作成日時
        $sql .= "  NOW() ";  //更新日時
        $sql .= ")";

        $param = [
            "id" => $id,
            "name" => $name,
            "name_kana" => $nameKana,
            "birthday" => $birthday,
            "gender" => $gender,
            "organization" => $organization,
            "post" => $post,
            "start_date" => $startDate,
            "tel" => $tel,
            "mail_address" => $mailAddress,
        ];
        return DataBase::execute($sql, $param);
    }

    /**
     * 社員情報を更新する
     *
     * @param string $id 社員番号
     * @param string $name 氏名
     * @param string $nameKana 氏名カナ
     * @param string $birthday 誕生日
     * @param string $gender 性別
     * @param string $organization 部署
     * @param string $post 役職
     * @param string $startDate 入社年月日
     * @param string $tel 電話番号
     * @param string $mailAddress メールアドレス
     * @return bool SQL実行結果
     */
    public static function update(
        string $id,
        string $name,
        string $nameKana,
        string $birthday,
        string $gender,
        string $organization,
        string $post,
        string $startDate,
        string $tel,
        string $mailAddress
    ): bool {
        $sql  = "UPDATE users ";
        $sql .= "SET name = :name, ";
        $sql .= "  name_kana = :name_kana, ";
        $sql .= "  birthday = :birthday, ";
        $sql .= "  gender = :gender, ";
        $sql .= "  organization = :organization, ";
        $sql .= "  post = :post, ";
        $sql .= "  start_date = :start_date, ";
        $sql .= "  tel = :tel, ";
        $sql .= "  mail_address = :mail_address, ";
        $sql .= "  updated = NOW() "; //更新日時
        $sql .= "WHERE id = :id ";

        $param = [
            "id" => $id,
            "name" => $name,
            "name_kana" => $nameKana,
            "birthday" => $birthday,
            "gender" => $gender,
            "organization" => $organization,
            "post" => $post,
            "start_date" => $startDate,
            "tel" => $tel,
            "mail_address" => $mailAddress,
        ];
        return DataBase::execute($sql, $param);
    }

    /**
     * 検索条件SQL生成
     *
     * @param string $prefecture 都道府県
     * @param string $region 地方
     * @param string $stay_level 滞在レベル
     * @param string $visit_date 訪問日
     * @return array WHERE句のSQL, SQLに渡すパラメータ
     */
    private static function getSearchWhereSqlAndParam(
        $prefecture,
        $region,
        $stay_level,
        $visit_date
    ): array
    {
        $whereSql = '';
        $param = [];
        // 都道府県、地方、滞在レベルに「--すべての記録を見る--」が含まれる　かつ
        // 訪問日が空白の場合は全件検索
        // 都道府県に「--すべての記録を見る--」入力されているか
        if ($prefecture !== '--すべての記録を見る--') {
            // 検索条件に都道府県を追加
            $whereSql .= 'AND prefecture = :prefecture ';
            $param['prefecture'] = $prefecture;
        }
        // 地方に「--すべての記録を見る--」が入力されているか
        if ($region !== '--すべての記録を見る--') {
            // 検索条件に地方を追加
            $whereSql .= 'AND region = :region ';
            $param['region'] = $region;
        }
        // 滞在に「--すべての記録を見る--」レベルが入力されているか
        if ($stay_level !== '--すべての記録を見る--') {
            // 検索条件に滞在レベルを追加
            $whereSql .= 'AND stay_level = :stay_level ';
            $param['stay_level'] = $stay_level;
        }
        // 訪問日が入力されている
        if ($visit_date !== '') {
            // 検索条件に訪問日を追加
            $whereSql .= 'AND visit_date = :visit_date ';
            $param['visit_date'] = $visit_date;
        }
        return [$whereSql, $param];
    }
}

?>