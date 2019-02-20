<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorAdminMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_menus', function (Blueprint $table) {
            $table
                ->text('desc')
                ->nullable()
                ->collation('utf8_unicode_ci')
                ->charset('utf8');

            $table
                ->string('bullet', 45)
                ->nullable()
                ->collation('utf8_unicode_ci')
                ->charset('utf8');

            $table
                ->text('translate')
                ->nullable()
                ->collation('utf8_unicode_ci')
                ->charset('utf8')
                ->comment('Ключ для перевода');

            $table
                ->string('badgeType', 45)
                ->nullable()
                ->collation('utf8_unicode_ci')
                ->charset('utf8');

            $table
                ->string('badgeValue', 45)
                ->nullable()
                ->collation('utf8_unicode_ci')
                ->charset('utf8');

            $table
                ->text('page')
                ->nullable()
                ->collation('utf8_unicode_ci')
                ->charset('utf8')
                ->comment('Ссылка на страницу Angular-приложения');

            $table->dropColumn(['controller', 'function', 'args']);

            $table->renameColumn('name', 'title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_menus', function (Blueprint $table) {
            $table->dropColumn(['desc', 'bullet', 'translate', 'badgeType', 'badgeValue', 'page']);

            $table->string('controller', 45);
            $table->string('function', 45);
            $table->string('args', 45);

            $table->renameColumn('title', 'name');
        });
    }
}
