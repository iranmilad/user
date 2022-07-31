<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS `PMONTH`;
       
        CREATE FUNCTION `PMONTH`(`gdate` datetime) RETURNS char(100) CHARSET utf8
        READS SQL DATA
        DETERMINISTIC
        BEGIN
        # Copyright (C) 2009-2019 Mohammad Saleh Souzanchi
        # WebLog : www.saleh.soozanchi.ir
        # Version V2.0.0
        
            DECLARE
                i,
                gy, gm, gd,
                g_day_no, j_day_no, j_np,
                jy, jm, jd INT DEFAULT 0; /* Can be unsigned int? */
        
            SET gy = YEAR(gdate) - 1600;
            SET gm = MONTH(gdate) - 1;
            SET gd = DAY(gdate) - 1;
            SET g_day_no = ((365 * gy) + __mydiv(gy + 3, 4) - __mydiv(gy + 99, 100) + __mydiv(gy + 399, 400));
            SET i = 0;
        
            WHILE (i < gm) do
                SET g_day_no = g_day_no + _gdmarray(i);
                SET i = i + 1;
            END WHILE;
        
            IF gm > 1 and ((gy % 4 = 0 and gy % 100 <> 0)) or gy % 400 = 0 THEN
                SET g_day_no = g_day_no + 1;
            END IF;
        
            SET g_day_no = g_day_no + gd;
            SET j_day_no = g_day_no - 79;
            SET j_np = j_day_no DIV 12053;
            set j_day_no = j_day_no % 12053;
            SET jy = 979 + 33 * j_np + 4 * __mydiv(j_day_no, 1461);
            SET j_day_no = j_day_no % 1461;
        
            IF j_day_no >= 366 then
                SET jy = jy + __mydiv(j_day_no - 1, 365);
                SET j_day_no =(j_day_no - 1) % 365;
            END IF;
        
            SET i = 0;
        
            WHILE (i < 11 and j_day_no >= _jdmarray(i)) do
                SET j_day_no = j_day_no - _jdmarray(i);
                SET i = i + 1;
            END WHILE;
        
            SET jm = i + 1;
            SET jd = j_day_no + 1;
            RETURN jm;
        END;

        -- ----------------------------
        -- Function structure for `pyear`
        -- ----------------------------
        DROP FUNCTION IF EXISTS `pyear`;
        CREATE FUNCTION `pyear`(`gdate` datetime) RETURNS char(100) CHARSET utf8
        READS SQL DATA
        DETERMINISTIC
        BEGIN
        # Copyright (C) 2009-2019 Mohammad Saleh Souzanchi
        # WebLog : www.saleh.soozanchi.ir
        # Version V2.0.0

            DECLARE
                i,
                gy, gm, gd,
                g_day_no, j_day_no, j_np,
                jy, jm, jd INT DEFAULT 0; /* Can be unsigned int? */

            SET gy = YEAR(gdate) - 1600;
            SET gm = MONTH(gdate) - 1;
            SET gd = DAY(gdate) - 1;
            SET g_day_no = ((365 * gy) + __mydiv(gy + 3, 4) - __mydiv(gy + 99, 100) + __mydiv(gy + 399, 400));
            SET i = 0;

            WHILE (i < gm) do
                SET g_day_no = g_day_no + _gdmarray(i);
                SET i = i + 1;
            END WHILE;

            IF gm > 1 and ((gy % 4 = 0 and gy % 100 <> 0)) or gy % 400 = 0 THEN
                SET g_day_no =	g_day_no + 1;
            END IF;

            SET g_day_no = g_day_no + gd;
            SET j_day_no = g_day_no - 79;
            SET j_np = j_day_no DIV 12053;
            set j_day_no = j_day_no % 12053;
            SET jy = 979 + 33 * j_np + 4 * __mydiv(j_day_no, 1461);
            SET j_day_no = j_day_no % 1461;

            IF j_day_no >= 366 then
                SET jy = jy + __mydiv(j_day_no - 1, 365);
                SET j_day_no = (j_day_no - 1) % 365;
            END IF;

            SET i = 0;

            WHILE (i < 11 and j_day_no >= _jdmarray(i)) do
                SET j_day_no = j_day_no - _jdmarray(i);
                SET i = i + 1;
            END WHILE;

            SET jm = i + 1;
            SET jd = j_day_no + 1;
            RETURN jy;
        END;
        -- ----------------------------
        -- Function structure for `__mydiv`
        -- ----------------------------
        DROP FUNCTION IF EXISTS `__mydiv`;
        CREATE DEFINER=`root`@`localhost` FUNCTION `__mydiv`(`a` int, `b` int) RETURNS bigint(20)
        READS SQL DATA
        DETERMINISTIC
        BEGIN
        # Copyright (C) 2009-2019 Mohammad Saleh Souzanchi
        # WebLog : www.saleh.soozanchi.ir
        # Version V2.0.0

            return FLOOR(a / b);
        END;
        -- ----------------------------
        -- Function structure for `_gdmarray`
        -- ----------------------------
        DROP FUNCTION IF EXISTS `_gdmarray`;
        CREATE DEFINER=`root`@`localhost` FUNCTION `_gdmarray`(`m` smallint) RETURNS smallint(2)
        READS SQL DATA
        DETERMINISTIC
        BEGIN
        # Copyright (C) 2009-2019 Mohammad Saleh Souzanchi
        # WebLog : www.saleh.soozanchi.ir
        # Version V2.0.0

            CASE m
                WHEN 0 THEN RETURN 31;
                WHEN 1 THEN RETURN 28;
                WHEN 2 THEN RETURN 31;
                WHEN 3 THEN RETURN 30;
                WHEN 4 THEN RETURN 31;
                WHEN 5 THEN RETURN 30;
                WHEN 6 THEN RETURN 31;
                WHEN 7 THEN RETURN 31;
                WHEN 8 THEN RETURN 30;
                WHEN 9 THEN RETURN 31;
                WHEN 10 THEN RETURN 30;
                WHEN 11 THEN RETURN 31;
            END CASE;

        END;
        -- ----------------------------
        -- Function structure for `_jdmarray`
        -- ----------------------------
        DROP FUNCTION IF EXISTS `_jdmarray`;
        CREATE DEFINER=`root`@`localhost` FUNCTION `_jdmarray`(`m` smallint) RETURNS smallint(2)
        READS SQL DATA
        DETERMINISTIC
        BEGIN
        # Copyright (C) 2009-2019 Mohammad Saleh Souzanchi
        # WebLog : www.saleh.soozanchi.ir
        # Version V2.0.0

            CASE m
                WHEN 0 THEN RETURN 31;
                WHEN 1 THEN RETURN 31;
                WHEN 2 THEN RETURN 31;
                WHEN 3 THEN RETURN 31;
                WHEN 4 THEN RETURN 31;
                WHEN 5 THEN RETURN 31;
                WHEN 6 THEN RETURN 30;
                WHEN 7 THEN RETURN 30;
                WHEN 8 THEN RETURN 30;
                WHEN 9 THEN RETURN 30;
                WHEN 10 THEN RETURN 30;
                WHEN 11 THEN RETURN 29;
            END CASE;

        END;
        -- ----------------------------
        -- Function structure for `pdate`
        -- ----------------------------
        DROP FUNCTION IF EXISTS `pdate`;
        CREATE DEFINER=`root`@`localhost` FUNCTION `pdate`(`gdate` datetime) RETURNS char(100) CHARSET utf8
        READS SQL DATA
        DETERMINISTIC
        BEGIN
        # Copyright (C) 2009-2019 Mohammad Saleh Souzanchi
        # WebLog : www.saleh.soozanchi.ir
        # Version V2.0.0

            DECLARE
                i,
                gy, gm, gd,
                g_day_no, j_day_no, j_np,jy INT DEFAULT 0;  /* Can be unsigned int? */
            DECLARE jm, jd INT(2) ZEROFILL DEFAULT 0;
            DECLARE resout char(100);
            DECLARE ttime CHAR(20);

            SET gy = YEAR(gdate) - 1600;
            SET gm = MONTH(gdate) - 1;
            SET gd = DAY(gdate) - 1;
            SET ttime = TIME(gdate);
            SET g_day_no = ((365 * gy) + __mydiv(gy + 3, 4) - __mydiv(gy + 99, 100) + __mydiv (gy + 399, 400));
            SET i = 0;

            WHILE (i < gm) do
                SET g_day_no = g_day_no + _gdmarray(i);
                SET i = i + 1;
            END WHILE;

            IF gm > 1 and ((gy % 4 = 0 and gy % 100 <> 0)) or gy % 400 = 0 THEN
                SET g_day_no =	g_day_no + 1;
            END IF;

            SET g_day_no = g_day_no + gd;
            SET j_day_no = g_day_no - 79;
            SET j_np = j_day_no DIV 12053;
            SET j_day_no = j_day_no % 12053;
            SET jy = 979 + 33 * j_np + 4 * __mydiv(j_day_no, 1461);
            SET j_day_no = j_day_no % 1461;

            IF j_day_no >= 366 then
                SET jy = jy + __mydiv(j_day_no - 1, 365);
                SET j_day_no = (j_day_no - 1) % 365;
            END IF;

            SET i = 0;

            WHILE (i < 11 and j_day_no >= _jdmarray(i)) do
                SET j_day_no = j_day_no - _jdmarray(i);
                SET i = i + 1;
            END WHILE;

            SET jm = i + 1;
            SET jd = j_day_no + 1;
            SET resout = CONCAT_WS ("-", jy, jm, jd);

            IF (ttime <> "00:00:00") then
                SET resout = CONCAT_WS(" ", resout, ttime);
            END IF;

            RETURN resout;
        END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::unprepared("DROP FUNCTION IF EXISTS `PMONTH`;
       DROP FUNCTION IF EXISTS `pyear`;
       DROP FUNCTION IF EXISTS `__mydiv`;
       DROP FUNCTION IF EXISTS `_gdmarray`;
       DROP FUNCTION IF EXISTS `_jdmarray`;
       DROP FUNCTION IF EXISTS `pdate`;
       "
    );
    }
};
