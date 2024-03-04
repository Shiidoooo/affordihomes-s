<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Add Schedule</title>
</head>
<body class="bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:outline-none focus:ring-lime-200">
    @include('common.header')
    <br><br>

    <div class="">
        <form action="{{route('schedule.store')}}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto ">
        @csrf
        <label for="property_id">Property:</label>
        <select name="property_id" id="property_id">
            <option value="" disabled selected>Select Property Number</option>
            @foreach ($propertyid as $property)
                <option value="{{$property->id}}">Property ID {{$property->id}}</option>
            @endforeach
        </select>
        <br><br>
        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" required>
        <br><br>
        <label for="times">Select Time:</label>
        <select name="times[]" id="times" multiple required>
            <option value="00:00">00:00</option>
            @for ($hour = 1; $hour <= 11; $hour++)
                <option value="{{ sprintf('%02d', $hour) }}:00">{{ sprintf('%02d', $hour) }}:00</option>
            @endfor
            <option value="12:00">12:00 PM</option>
            @for ($hour = 1; $hour <= 11; $hour++)
                <option value="{{ sprintf('%02d', $hour + 12) }}:00">{{ sprintf('%02d', $hour + 12) }}:00</option>
            @endfor
        </select>
        <br><br>
            <button type="submit" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:px-6 hover:py-3.5 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Submit</button>
        </form>
    </div>

    <br>
    @include('common.footer')
</body>
</html>