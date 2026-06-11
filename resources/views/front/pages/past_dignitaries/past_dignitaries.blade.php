@extends('front.layout.layout')
@section('content')
<style>
#tableSearch { text-align: center; }
</style>
<main>
  <!-- <section class="contact_us_wrapper_sec">
    <div class="heading-one d-flex align-items-center justify-content-center h-100">
      <h1>Downloads</h1>
    </div>
  </section> -->
  <section class="list_committes_wrap_sec">
    <div class="heading-one heading_one_dtba" data-aos="fade-up">
      <h1 class="text-center img-text">Past Dignitaries</h1>
      <div class="underline mx-auto mt-2"></div>
    </div>
  </section>
  <section>
    <div class="container my-5" data-aos="fade-up">
      <div class="table-responsive">
        <input type="text" id="tableSearch" class="form-control mb-3" placeholder="Search year, president, or secretary">
        <div id="searchError" style="color:red; display:none; margin-bottom:10px;">Invalid input! Only letters, numbers, and spaces allowed.</div>

        <table class="table custom-table" id="dignitariesTable">
          <thead>
            <tr>
              <th>Year</th>
              <th>President</th>
              <th>Secretary</th>
            </tr>
          </thead>
          <tbody>
            @foreach($past_dignitaries as $past_dignitary)
            <tr>
              <td><strong>{{ $past_dignitary['year'] }}</strong></td>
              <td><strong>{{ $past_dignitary['president'] }}</strong></td>
              <td><strong>{{ $past_dignitary['secretary'] }}</strong></td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>

  </section>

</main>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("tableSearch");
    const errorDiv = document.getElementById("searchError");
    const tableRows = document.querySelectorAll("#dignitariesTable tbody tr");
    searchInput.addEventListener("input", function() {
      const value = searchInput.value.trim();
      // Validation: allow only letters, numbers, and spaces
      const isValid = /^[a-zA-Z0-9\s]*$/.test(value);
      if (!isValid) {
        errorDiv.style.display = "block";
        return;
      } else {
        errorDiv.style.display = "none";
      }
      // Filter table rows
      tableRows.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(value.toLowerCase()) ? "" : "none";
      });
    });
  });
</script>
@endsection