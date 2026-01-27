<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Trigger: Decrease Stock
        DB::unprepared('
            CREATE TRIGGER decrease_stock_after_approve AFTER UPDATE ON loans
            FOR EACH ROW
            BEGIN
                IF NEW.status = "approved" AND OLD.status != "approved" THEN
                    UPDATE tools SET stock = stock - 1 WHERE id = NEW.tool_id;
                END IF;
            END
        ');

        // Trigger: Increase Stock
        DB::unprepared('
            CREATE TRIGGER increase_stock_after_return AFTER UPDATE ON loans
            FOR EACH ROW
            BEGIN
                IF NEW.status = "returned" AND OLD.status != "returned" THEN
                    UPDATE tools SET stock = stock + 1 WHERE id = NEW.tool_id;
                END IF;
            END
        ');

        // Function: Calculate Fine
        // Assuming 5000 per day fine
        DB::unprepared('
            CREATE FUNCTION calculate_fine(due_date DATE, return_date DATE) RETURNS DECIMAL(10,2)
            DETERMINISTIC
            BEGIN
                DECLARE fine DECIMAL(10,2);
                DECLARE days_late INT;
                SET fine = 0;
                IF return_date > due_date THEN
                    SET days_late = DATEDIFF(return_date, due_date);
                    SET fine = days_late * 5000;
                END IF;
                RETURN fine;
            END
        ');

        // Procedure: Process Loan Approval
        DB::unprepared('
            CREATE PROCEDURE process_loan_approval(IN loanId INT, IN adminId INT)
            BEGIN
                DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
                START TRANSACTION;
                
                UPDATE loans SET status = "approved" WHERE id = loanId;
                
                INSERT INTO activity_logs (user_id, action, description, created_at, updated_at)
                VALUES (adminId, "Approve Loan", CONCAT("Loan ", loanId, " approved"), NOW(), NOW());
                
                COMMIT;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS decrease_stock_after_approve');
        DB::unprepared('DROP TRIGGER IF EXISTS increase_stock_after_return');
        DB::unprepared('DROP FUNCTION IF EXISTS calculate_fine');
        DB::unprepared('DROP PROCEDURE IF EXISTS process_loan_approval');
    }
};
