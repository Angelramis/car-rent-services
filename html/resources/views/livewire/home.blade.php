<section class="text-center py-16">
  <div class="container mx-auto px-4">
      <p class="text-lg">Servicios de alquiler de coches</p>
  </div>

  <form action="{{ route('car-list') }}" method="POST">
    @csrf 
    <label for="">Fecha de recogida</label>
    <input type="date" name="pickup_date" id="">

    <label for="">Fecha de devolución</label>
    <input type="date" name="dropoff_date" id="">

    <label for="">Número de asientos</label>
    <input type="text" name="seat_number" id="">

    <label for="">Edad</label>
    <input type="number" name="age" id="">

    <input type="submit" value="Buscar">
  </form>

</section>
{{-- @livewire('searchbox') --}}