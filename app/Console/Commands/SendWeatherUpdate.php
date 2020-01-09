<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Remindr;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;

class SendWeatherUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weathermessage:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check weather update and send it to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $remindrs=Remindr::all()->toArray();
        $this->info('all remindr found');

        foreach($remindrs as $remindr){

            $time=$remindr['time'];
            $time=Carbon::create($time)->toTimeString();
            $add_time= Carbon::now('+1:00')->addMinutes(15)->toTimeString();    
            $sub_time=Carbon::now('+1:00')->subMinutes(15)->toTimeString();  

                $this->info($sub_time);
                $this->info($add_time);
                
            if(($time > $sub_time) && ($time < $add_time) && !($remindr['completed'])){

                $this->info($time.' is ready for cronjob');
                $this->info($remindr['location']);

                $user=User::find($remindr['user_id'])->toArray();

                //new Guzzle client for api consumption 
                $client = new Client([
                    'base_uri' => 'http://api.openweathermap.org'
                ]);
                //sending request....
                $response = $client->request('GET','/data/2.5/weather', [
                    'query'=>[
                        'q'=>$remindr['location'],
                        'APPID'=>/*'b6907d289e10d714a6e88b30761fae22'*/ 'cce3166f83bd77de2fef824e8b3e9736',
                        'units'=>'metric'
                    ]
                ]);
                $code=$response->getStatusCode();
                $this->info($code);
                $body=$response->getBody();
                $this->info($body);

                if($code==200 && !empty($body)){

                    $weather=json_decode($body,true);
                    // $this->info($weather['coord']['lat']);
                    // $this->info($weather['name']);
                    // $this->info($weather['sys']['country']);
                    $report='Hello '.$user['name'].',The weather conditions of '.$remindr['location'].' is as follows.The weather is '.$weather['weather'][0]['main'].' and the temperature is '.$weather['main']['temp'].' celsius the pressure and humidity is '.$weather['main']['pressure'].'hPa and '.$weather['main']['humidity'].'%';

                    $client = new Client([
                        'base_uri' => 'https://www.bulksmsnigeria.com'
                    ]);
                    //sending request....
                    $response = $client->request('GET','/api/v1/sms/create', [
                        'query'=>[
                            'api_token'=>'8iJwYV31wRVi7ORBFHbVizXLFg2mALS3EW8DJR9nIfoCYj9zAcTJMv2mwNSt',
                            'from'=>'Weatherly',
                            'to'=>$user['number'],
                            'body'=>$report,
                            'dnd'=>'2'
                        ]
                    ]);
                    $code=$response->getStatusCode();
                    $body=$response->getBody();
                    $body=json_decode($body,true);
                    if($code==200 && ($body['data']['status'])=='success'){

                        $user=Remindr::where(['id'=>$remindr['id']])->update(['completed'=> true]);; 

                    }
                }

                //file......
                // $handle=fopen(__DIR__.'file.json','r');
                // $weather=fread($handle,filesize(__DIR__.'file.json'));
                // fclose($handle);
                //https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=8iJwYV31wRVi7ORBFHbVizXLFg2mALS3EW8DJR9nIfoCYj9zAcTJMv2mwNSt&from=BulkSMS.ng&to=2347034528013&body=Welcome&dnd=2
                



            
            }else{

                $this->error($time.' is not yet ready for cronjob');
                $this->info('');
            }
        }
    }
}
