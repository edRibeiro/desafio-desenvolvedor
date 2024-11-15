<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instrumentos', function (Blueprint $table) {
            $table->uuid('_id');
            $table->date('RptDt')->nullable();
            $table->string('TckrSymb')->nullable();
            $table->string('Asst')->nullable();
            $table->string('AsstDesc')->nullable();
            $table->string('SgmtNm')->nullable();
            $table->string('MktNm')->nullable();
            $table->string('SctyCtgyNm')->nullable();
            $table->date('XprtnDt')->nullable();
            $table->string('XprtnCd')->nullable();
            $table->date('TradgStartDt')->nullable();
            $table->date('TradgEndDt')->nullable();
            $table->string('BaseCd')->nullable();
            $table->string('ConvsCritNm')->nullable();
            $table->string('MtrtyDtTrgtPt')->nullable();
            $table->boolean('ReqrdConvsInd')->nullable();
            $table->string('ISIN')->nullable();
            $table->string('CFICd')->nullable();
            $table->date('DlvryNtceStartDt')->nullable();
            $table->date('DlvryNtceEndDt')->nullable();
            $table->string('OptnTp')->nullable();
            $table->float('CtrctMltplr')->nullable();
            $table->float('AsstQtnQty')->nullable();
            $table->integer('AllcnRndLot')->nullable();
            $table->string('TradgCcy')->nullable();
            $table->string('DlvryTpNm')->nullable();
            $table->integer('WdrwlDays')->nullable();
            $table->integer('WrkgDays')->nullable();
            $table->integer('ClnrDays')->nullable();
            $table->string('RlvrBasePricNm')->nullable();
            $table->integer('OpngFutrPosDay')->nullable();
            $table->string('SdTpCd1')->nullable();
            $table->string('UndrlygTckrSymb1')->nullable();
            $table->string('SdTpCd2')->nullable();
            $table->string('UndrlygTckrSymb2')->nullable();
            $table->float('PureGoldWght')->nullable();
            $table->float('ExrcPric')->nullable();
            $table->string('OptnStyle')->nullable();
            $table->string('ValTpNm')->nullable();
            $table->boolean('PrmUpfrntInd')->nullable();
            $table->date('OpngPosLmtDt')->nullable();
            $table->string('DstrbtnId')->nullable();
            $table->float('PricFctr')->nullable();
            $table->integer('DaysToSttlm')->nullable();
            $table->string('SrsTpNm')->nullable();
            $table->boolean('PrtcnFlg')->nullable();
            $table->boolean('AutomtcExrcInd')->nullable();
            $table->string('SpcfctnCd')->nullable();
            $table->string('CrpnNm')->nullable();
            $table->date('CorpActnStartDt')->nullable();
            $table->string('CtdyTrtmntTpNm')->nullable();
            $table->float('MktCptlstn')->nullable();
            $table->string('CorpGovnLvlNm')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumentos');
    }
};
