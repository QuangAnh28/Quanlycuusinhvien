@php($role = auth()->check() ? auth()->user()->role : null)

<style>
  .f-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
  .f-item{display:flex;flex-direction:column;gap:6px}
  .f-item label{font-weight:700;font-size:13px;opacity:.85}
  .f-input{
    padding:11px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.12);
    outline:none;background:#fff
  }
  .f-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:14px}
  .btnx{
    display:inline-flex;align-items:center;gap:8px;
    padding:10px 12px;border-radius:12px;border:1px solid rgba(0,0,0,.12);
    background:#fff;text-decoration:none;font-weight:800;cursor:pointer
  }
  .btnx.primary{background:#0b5fff;color:#fff;border-color:#0b5fff}
  .btnx.ghost{background:transparent}
  @media(max-width:900px){ .f-grid{grid-template-columns:1fr} }
</style>

<div class="f-grid">
  <div class="f-item">
    <label>MSSV</label>
    <input class="f-input" name="student_code" value="{{ old('student_code', $alumni->student_code ?? '') }}">
  </div>

  <div class="f-item">
    <label>Họ tên *</label>
    <input class="f-input" name="full_name" required value="{{ old('full_name', $alumni->full_name ?? '') }}">
  </div>

  <div class="f-item">
    <label>Email</label>
    <input class="f-input" type="email" name="email" value="{{ old('email', $alumni->email ?? '') }}">
  </div>

  <div class="f-item">
    <label>Số điện thoại</label>
    <input class="f-input" name="phone" value="{{ old('phone', $alumni->phone ?? '') }}">
  </div>

  @if($role === 'admin')
    <div class="f-item">
      <label>Khoa</label>
      <input class="f-input" name="faculty" value="{{ old('faculty', $alumni->faculty ?? '') }}">
    </div>
  @endif

  <div class="f-item">
    <label>Lớp / Ngành</label>
    <input class="f-input" name="major" value="{{ old('major', $alumni->major ?? '') }}">
  </div>

  <div class="f-item">
    <label>Năm tốt nghiệp</label>
    <input class="f-input" type="number" name="graduation_year" min="1900" max="2100"
           value="{{ old('graduation_year', $alumni->graduation_year ?? '') }}">
  </div>

  <div class="f-item">
    <label>Công việc</label>
    <input class="f-input" name="job" value="{{ old('job', $alumni->job ?? '') }}">
  </div>

  <div class="f-item">
    <label>Công ty</label>
    <input class="f-input" name="company" value="{{ old('company', $alumni->company ?? '') }}">
  </div>

  <div class="f-item">
    <label>Địa chỉ</label>
    <input class="f-input" name="address" value="{{ old('address', $alumni->address ?? '') }}">
  </div>
</div>

<div class="f-actions">
  <button class="btnx primary" type="submit">{{ $submitText ?? 'Lưu' }}</button>
  <a class="btnx ghost" href="{{ route('alumni.index') }}">Về danh sách</a>
</div>