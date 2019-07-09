<div>
    <div class="reveal" id="product-review-modal" data-reveal>
      <div>
        <form action="{{route('review.store')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label>Rate it</label>
            <input type="text" class="form-control" name="rating" placeholder="input">
          </div>

          <div class="form-group">
            <label>HeadLine</label>
            <input type="text" class="form-control" name="headline" placeholder="input">
          </div>

          <div class="form-group">
            <label>Tell us more</label>
            <input type="text" class="form-control" name="description" placeholder="input">
          </div>

          <input type="hidden" name="product_id" value="{{$product->id}}">

          <button type="submit" class="submit">Submit</button>                  
        </form>
      </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
