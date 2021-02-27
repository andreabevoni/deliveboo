<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //--------------------- 1 a n ----------------------//

        Schema::table('food', function (Blueprint $table) {
            $table->foreign('user_id', 'food-user')
                ->references('id')
                ->on('users');  //nome tabella da agganciare
        });

        // ------------------------- N a N ---------------------------//

        Schema::table('typology_user', function (Blueprint $table) {

            $table->foreign('user_id', 'tu-user')
                ->references('id')
                ->on('users');  //nome tabella da agganciare

            $table->foreign('typology_id', 'tu-typ')
                ->references('id')
                ->on('typologies');  //nome tabella da agganciare
        });


        Schema::table('food_order', function (Blueprint $table) {

            $table->foreign('food_id', 'fo-food')
                ->references('id')
                ->on('food');  //nome tabella da agganciare

            $table->foreign('order_id', 'fo-order')
                ->references('id')
                ->on('orders');  //nome tabella da agganciare
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //--------------------- 1 a n ----------------------//


        Schema::table('food', function (Blueprint $table) {

            $table->dropForeign('food-user');
        });



        // ------------------------- N a N ---------------------------//


        Schema::table('typology_user', function (Blueprint $table) {

            $table->dropForeign('tu-typ');
            $table->dropForeign('tu-user');
        });

        Schema::table('food_order', function (Blueprint $table) {

            $table->dropForeign('fo-order');
            $table->dropForeign('fo-food');
        });
    }
}
