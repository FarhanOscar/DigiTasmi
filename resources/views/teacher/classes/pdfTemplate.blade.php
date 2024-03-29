<!DOCTYPE html>
<html>

<head>
    <title></title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        h1 {
            font-size: 3em; /* Adjust the font size as needed */
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
          <td align="top">
            <img src="data:image/png;base64, {{ $image }}" style="width: 150px; height: 150px;">
            <h1 style="display: inline-block; margin-left: 10px;  margin-bottom: 50px;">DigiTasmi</h1>
        </td>
      
        </tr>

    </table>


    <table  width="100%">
        <thead>
            <tr>
                <td align="left"> <strong>Name:</strong> {{ Auth::user()->name }}
                </td>
                <td align="left"><strong> Class Name:</strong> {{ $className->ClassName }}</td>
            </tr>

            <tr class="bg-white border-b border-blue-500">
                <td align="left"> <strong> Month:</strong>
                    {{ $monthselect ? date('F', mktime(0, 0, 0, $monthselect, 1)) : 'All Record' }}
                </td>
                <td align="left"> <strong> Year:</strong> {{ $yearselect }}</td>
            </tr>
        </thead>
    </table>

    <div style="height: 1.5%"></div>


    <table style="border-collapse: collapse; border: 1px solid black;" width="100%">
        <thead style="background-color: lightgray;">
            <tr >
                <th style="border-top: 1px solid black; border-right: 1px solid black;" >No.</th>
                <th style="border-top: 1px solid black; border-right: 1px solid black;">Student Name</th>
                <th style="border-top: 1px solid black; border-right: 1px solid black;">Surah</th>
                <th style="border-top: 1px solid black; border-right: 1px solid black;">Juz</th>
                <th style="border-top: 1px solid black; border-right: 1px solid black;">Page</th>
                <th style="border-top: 1px solid black;">Ayat</th>
          


            </tr>
           
                      

        </thead>
        <tbody> 
            @php
            $currentDate = null;
        @endphp
                                  @forelse ($classdata as $data)

                                  @php
                                  $date = date('d-m-Y', strtotime($data->created_at));
                                  $day = date('l', strtotime($data->created_at));
                          
                                  // Display the date only if it's different from the previous row
                                  if ($date !== $currentDate) {
                                      $currentDate = $date;
                              @endphp
                              
            <tr>
                        <th colspan="6" style="background-color: lightgray; border-top: 1px solid black;" >
    {{ $day }}, {{ $date }}
</th>
                        </tr>
                        @php
                    }
                @endphp
                        
                <tr>

                    <th style="border-top: 1px solid black; border-right: 1px solid black; padding-top: 5px; padding-bottom: 5px;" scope="row"> {{ $loop->iteration }}</th>
                    <td style="border-top: 1px solid black; border-right: 1px solid black; padding-top: 5px; padding-bottom: 5px; " align="left">{{ " ".$data->student->name }}</td>
                    <td style="border-top: 1px solid black; border-right: 1px solid black; padding-top: 5px; padding-bottom: 5px; " scope="row" >{{ " ".$data->surah->SurahName }}</td>
                    <td style="border-top: 1px solid black; border-right:  1px solid black;padding-top: 5px; padding-bottom: 5px;" align="right">{{ " ". $data->TasmiSurahJuz }}</td>
                    <td style="border-top: 1px solid black; border-right: 1px solid black; padding-top: 5px; padding-bottom: 5px;" align="right">{{ " ".$data->TasmiSurahPage }}</td>
                    <td style="border-top: 1px solid black;padding-top: 5px; padding-bottom: 5px;" align="right">{{ " ". $data->TasmiSurahAyat }}</td>


                   

                </tr>
      
        @empty
        <tr  >
            
<td colspan="5" style="text-align: center; padding: 8px 6px; font-weight: bold;  ">
               No results found</td>
            <td >
           
        </td>
        </tr> 
     </tbody>
        @endforelse

    </table>


    <footer style="text-align: center;
    margin-top: 2%;
    font-size: 0.8em;">
        <p>&copy; 2024 DigiTasmi</p>
    </footer>

</body>

</html>
