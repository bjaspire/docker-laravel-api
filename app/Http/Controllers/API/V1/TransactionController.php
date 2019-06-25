<?php

namespace App\Http\Controllers\API\V1;

use Validator;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


/**
 * @group Transaction
 *
 * APIs for Transaction
 */

class TransactionController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Transaction listing
     * @bodyParam page integer page
     * @bodyParam limit integer required limit
     * @bodyParam search[field] string
     * @bodyParam search[value] string
     * @response {
     * "status": "success",
     * "result": {
     * "total": 8,
     * "rows":
     *  [
     *    {
     *        "id": 8,
     *        "title": "fsda",
     *        "rate": 12,
     *        "qty": 12,
     *        "type": "purchase",
     *        "author": 2,
     *        "description": "fdafdasf",
     *        "created_at": "2019-06-23 13:33:26",
     *        "updated_at": "2019-06-23 13:33:26"
     *    },
     *    {
     *        "id": 7,
     *        "title": "fsda",
     *        "rate": 12,
     *        "qty": 12,
     *        "type": "purchase",
     *        "author": 2,
     *        "description": "fdafdasf",
     *        "created_at": "2019-06-23 13:33:25",
     *        "updated_at": "2019-06-23 13:33:25"
     *    }
     *   ]
     *  }
     *  }
     */
    public function index(Request $request, Transaction $transactions)
    {

        $transactions = $transactions->gettransactions($request);
        return response()->json([
            'status' => 'success',
            'result' => [
                'total' => $transactions->total(),
                'rows' => $transactions->items(),
            ],
        ]);
    }

    /**
     * Transaction Create
     * @bodyParam title string required title.
     * @bodyParam rate float required rate.
     * @bodyParam qty integer required qty.
     * @bodyParam type string required type.
     * @bodyParam author integer required author.
     * @bodyParam description string required description.
     * @response {
     *  "status": "success",
     *  "result":  {
     *          "id": 5,
     *          "title": "fsda",
     *          "rate": 12,
     *          "qty": 12,
     *          "type": "sales",
     *          "author": 1,
     *          "description": "fdafdasf",
     *          "created_at": "2019-06-25 10:41:50",
     *          "updated_at": "2019-06-25 10:41:50"
     *      }
     * }
     */
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required',
            'rate' => 'required',
            'qty' => 'required',
            'description' => 'required',
            'type' => 'required',
            'author' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $transaction = new Transaction();
            $transaction->title = $request->input('title');
            $transaction->rate = $request->input('rate');
            $transaction->qty = $request->input('qty');
            $transaction->description = $request->input('description');
            $transaction->type = $request->input('type');
            $transaction->author = $request->input('author');
            $transaction = $transaction->save();

            return response()->json([
                'status' => 'success',
                'result' => $transaction,
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => $validator->messages(),
            ]);
        }
    }

    /**
     * Transaction Show
     * @bodyParam transaction_id int required the ID of the transaction
     * @response {
     *  "status": "success",
     *  "result":  {
     *          "id": 5,
     *          "title": "fsda",
     *          "rate": 12,
     *          "qty": 12,
     *          "type": "sales",
     *          "author": 1,
     *          "description": "fdafdasf",
     *          "created_at": "2019-06-25 10:41:50",
     *          "updated_at": "2019-06-25 10:41:50"
     *      }
     * }
     */
    public function show(Transaction $transaction)
    {

        return $transaction;
        return response()->json([
            'status' => 'success',
            'result' => $transaction,
        ], 200);
    }
    /**
     * Transaction Update
     * @bodyParam transaction_id int required the ID of the transaction
     * @response {
     *  "status": "success",
     *  "result":  {
     *          "id": 5,
     *          "title": "fsda",
     *          "rate": 12,
     *          "qty": 12,
     *          "type": "sales",
     *          "author": 1,
     *          "description": "fdafdasf",
     *          "created_at": "2019-06-25 10:41:50",
     *          "updated_at": "2019-06-25 10:41:50"
     *      }
     * }
     */
    public function update(Transaction $transaction, Request $request)
    {
        $rules = [
            'title' => 'required',
            'rate' => 'required',
            'qty' => 'required',
            'description' => 'required',
            'type' => 'required',
            'author' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $transaction->title = $request->input('title');
            $transaction->rate = $request->input('rate');
            $transaction->qty = $request->input('qty');
            $transaction->description = $request->input('description');
            $transaction->type = $request->input('type');
            $transaction->author = $request->input('author');
            $transaction = $transaction->update();

            return response()->json([
                'status' => 'success',
                'result' => $transaction,
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => $validator->messages(),
            ]);
        }
    }

    /**
     * Transaction Delete
      * @bodyParam transaction_id int required the ID of the transaction
      * @response {
      *  "status": "success",
      *  "result": "null",
      *  "messages": null
      * }
     */
    public function destroy(Transaction $transaction)
    {

        $transaction->delete();
        return response()->json([
            'status' => 'success',
            'result' => 'null',
        ], 200);
    }
}
