<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Blog;
use App\Slider;
use App\Social;
use App\Frontend;
use App\Testimonial;
use App\Category;
use App\Feature;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FrontendController extends Controller
{

  public function aboutSection()
  {
      $front = Frontend::first();
      if(is_null($front))
      {
        $default = [
            'about_heading' => 'About Heading',
            'about_details' => 'about details',
            'about_image' => 'Image.jpg',
            'video' => 'videourl',
            'footer' => 'content',
            'contact_email' => 'content@email.com',
            'contact_number' => '010110010',
        ];
        Frontend::create($default);
        $front = Frontend::first();
      }
      $pt= "ABOUT SECTION";

      return view('admin.website.about', compact('front','pt'));
  }

  public function aboutUpdate(Request $request)
  {
      $front = Frontend::first();
      $this->validate($request,['about_heading' => 'required',
      'video' => 'required','about_details' => 'required',
      'about_company' => 'required',
      'about_image' => 'image|mimes:jpeg,png,jpg|max:4048',
       ]);

       if($request->hasFile('about_image'))
       {
            $oldpath = '/images/frontend/'.$front->about_image;
            if(file_exists($oldpath))
            {
                unlink($oldpath);
            }

            $front['about_image'] = uniqid().'.'.$request->about_image->getClientOriginalExtension();
            $path = '/images/frontend/'. $front['about_image'];
            Image::make($request->about_image)->resize(570, 400)->save($path);
       }

      $front['about_heading'] = $request->about_heading;
      $front['about_details'] = $request->about_details;
      $front['about_company'] = $request->about_company;
      $front['video'] = $request->video;
      $front->update();

      return back()->with('success','About Section Updated Successfully.');
  }

  public function bannerSection()
  {
      $front = Frontend::first();
      if(is_null($front))
      {
        $default = [
            'banner_heading' => 'Banner Heading',
            'banner_details' => 'Banner Details',
        ];
        Frontend::create($default);
        $front = Frontend::first();
      }
      $pt= "Banner SECTION";

      return view('admin.website.banner', compact('front','pt'));
  }

  public function bannerUpdate(Request $request)
  {
      $front = Frontend::first();
      $this->validate($request,['banner_heading' => 'required', 'banner_details' => 'required']);
      $front['banner_heading'] = $request->banner_heading;
      $front['banner_details'] = $request->banner_details;
      $front->update();

      if($request->hasFile('banner_image'))
       {
         Image::make($request->banner_image)->save('/img/bg/header-bg.png');
       }

      if($request->hasFile('bread'))
       {
         Image::make($request->bread)->save('/img/bg/breadcrumb-bg.png');
       }

      return back()->with('success','Banner Section Updated Successfully.');
  }

  public function footerSection()
  {
      $front = Frontend::first();
      if(is_null($front))
      {
        $default = [
            'about_heading' => 'About Heading',
            'about_details' => 'about details',
            'about_image' => 'Image.jpg',
            'video' => 'videourl',
            'footer' => 'content',
            'contact_email' => 'content@email.com',
            'contact_number' => '010110010',
        ];
        Frontend::create($default);
        $front = Frontend::first();
      }
      $pt= "FOOTER SECTION";

      return view('admin.website.footer', compact('front','pt'));
  }

  public function footerUpdate(Request $request)
  {
      $front = Frontend::first();
      $this->validate($request,['footer' => 'required',
      'contact_email' => 'required','contact_number' => 'required',
       ]);

      $front['footer'] = $request->footer;
      $front['contact_email'] = $request->contact_email;
      $front['contact_number'] = $request->contact_number;
      $front['contact_address'] = $request->contact_address;
      $front->update();

      return back()->with('success','Fooetr Section Updated Successfully.');
  }

  public function sliderSection()
  {
    $sliders = Slider::all();
    $front = Frontend::first();
    $pt= "SERVICE SECTION";
    return view('admin.website.slider', compact('sliders','pt','front'));
  }


  public function sliderStore(Request $request)
  {
      $this->validate($request,
          [
              'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
              'heading' => 'required',
              'details' => 'required',
          ]);

    if($request->hasFile('icon'))
        {
            $image = $request->file('icon');
            $slider['icon'] = uniqid().'.'.$request->icon->getClientOriginalExtension();
            $image->move(public_path() . '/images/slider', $slider['icon']);
        }

      $slider['heading'] = $request->heading;
      $slider['details'] = $request->details;
      Slider::create($slider);

      return back()->with('success', 'New Service Created Successfully!');
  }

 public function  sliderUpdate(Request $request, $id)
  {
      $slider = Slider::find($id);
      $this->validate($request,
      [
          'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
          'heading' => 'required',
          'details' => 'required',
      ]);
      if($request->hasFile('icon'))
      {
        $image = $request->file('icon');
        $slider['icon'] = uniqid().'.'.$request->icon->getClientOriginalExtension();
        $image->move(public_path() . '/images/slider', $slider['icon']);
      }
        $slider['heading'] = $request->heading;
        $slider['details'] = $request->details;
        $slider->update();

      return back()->with('success', 'Service Updated Successfully!');
  }

  public function  sliderDestroy($id)
  {
      $slider = Slider::findOrFail($id);

      $slider->delete();
      
      return back()->with('success', 'Service Deleted Successfully!');
  }

  public function testimonialSection()
  {
      $testimonials = Testimonial::all();
      $pt= "Testimonial SECTION";
      $front = Frontend::first();
      return view('admin.website.testimonial', compact('testimonials','pt','front'));
  }


  public function testimonialStore(Request $request)
  {
      $this->validate($request,
          [
              'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
              'name' => 'required',
              'heading' => 'required',
              'details' => 'required',
          ]);

        if($request->hasFile('photo'))
        {
            $testimonial['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $path = '/images/testimonial/'. $testimonial['photo'];
            Image::make($request->photo)->save($path);
        }
      $testimonial['name'] = $request->name;
      $testimonial['heading'] = $request->heading;
      $testimonial['details'] = $request->details;
      Testimonial::create($testimonial);

      return back()->with('success', 'New Testimonial Created Successfully!');
  }

 public function testimonialUpdate(Request $request, $id)
  {
      $testimonial = Testimonial::find($id);
      $this->validate($request,['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048','name' => 'required','heading' => 'required','details' => 'required', ]);

        if($request->hasFile('photo'))
        {
            $oldpath = '/images/testimonial/'.$testimonial->photo;
            if(file_exists($oldpath))
            {
                unlink($oldpath);
            }

            $testimonial['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $path = '/images/testimonial/'. $testimonial['photo'];
            Image::make($request->photo)->save($path);
        }
        $testimonial['name'] = $request->name;
        $testimonial['heading'] = $request->heading;
        $testimonial['details'] = $request->details;
        $testimonial->update();

      return back()->with('success', 'Testimonial Updated Successfully!');
  }

  public function  testimonialDestroy($id)
  {
      $testimonial = Testimonial::findOrFail($id);
      $path = '/images/testimonial/'.$testimonial->photo;

      if(file_exists($path))
      {
          unlink($path);
      }
      $testimonial->delete();
      
      return back()->with('success', 'Testimonial Deleted Successfully!');
  }
  public function faqSection()
  {
      $faqs = Faq::all();
      $front = Frontend::first();
      $pt= "FAQ SECTION";
      return view('admin.website.faq', compact('faqs','pt','front'));
  }

  public function faqStore(Request $request)
  {
      $this->validate($request,
          [
              'heading' => 'required',
              'details' => 'required',
          ]);

      $faq['heading'] = $request->heading;
      $faq['details'] = $request->details;
      Faq::create($faq);

      return back()->with('success', 'New faq Created Successfully!');
  }

 public function faqUpdate(Request $request, $id)
  {
      $faq = Faq::find($id);
      $this->validate($request,
      [
          'heading' => 'required',
          'details' => 'required',
      ]);

        $faq['heading'] = $request->heading;
        $faq['details'] = $request->details;
        $faq->update();

      return back()->with('success', 'Faq Updated Successfully!');
  }


  public function  faqDestroy($id)
  {
      $faq = Faq::findOrFail($id);
      $faq->delete();
      
      return back()->with('success', 'Faq Deleted Successfully!');
  }
  public function socialSection()
  {
      $socials = Social::all();
      $pt= "SOCIAL SECTION";
      return view('admin.website.social', compact('socials','pt'));
  }


  public function socialStore(Request $request)
  {
      $this->validate($request,
          [
              'icon' => 'required',
              'link' => 'required',
          ]);

      $social['icon'] = $request->icon;
      $social['link'] = $request->link;
      Social::create($social);

      return back()->with('success', 'New Social Icon Created Successfully!');
  }

 public function  socialUpdate(Request $request, $id)
    {
        $social = Social::find($id);
        $this->validate($request,
            [
                'icon' => 'required',
                'link' => 'required',
            ]);
            $social['icon'] = $request->icon;
            $social['link'] = $request->link;
        $social->update();

        return back()->with('success', 'Social Icon Updated Successfully!');
    }

  public function  socialDestroy($id)
  {
      $social = Social::findOrFail($id);
     
      $social->delete();
      
      return back()->with('success', 'Social Icon Deleted Successfully!');
  }

  public function blogSection()
  {
      $blogs = Blog::orderBy('id','DESC')->paginate(10);
      $pt= "BLOG SECTION";
      return view('admin.website.blog', compact('blogs','pt'));
  }

  public function blogCreate()
  {
    $pt= "Create Blog Post";
    $categorys = Category::all();
    return view('admin.website.post', compact('pt','categorys'));
  }

  public function blogStore(Request $request)
  {
      $this->validate($request,
        [
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            'heading' => 'required',
            'details' => 'required',
            'tags' => 'required',
            'category' => 'required'
        ]);

        if($request->hasFile('photo'))
        {
            $blog['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $path = '/images/blog/'. $blog['photo'];
            chmod(base_path().'/public/images/blog/', 0775);
            Image::make($request->photo)->save($path);
        }
      $blog['heading'] = $request->heading;
      $blog['slug'] = str_replace(' ', '_', strtolower(htmlspecialchars($request->heading)));
      $blog['details'] = $request->details;
      $blog['category_id'] = $request->category;
      $blog['tags'] = $request->tags;
      Blog::create($blog);

      return redirect()->route('admin.blogsection')->with('success', 'New Blog Post Created Successfully!');
  }

  public function blogSingle($id)
  {
      $blog = Blog::find($id);
      $pt=  $blog->heading;
      $categorys = Category::all();
      return view('admin.website.singlepost', compact('pt','blog','categorys'));
  }
  public function blogUpdate(Request $request, $id)
  {
      $blog = Blog::find($id);
      $this->validate($request,['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048','heading' => 'required','details' => 'required', 'tags' => 'required', 'category' => 'required']);

        if($request->hasFile('photo'))
        {
            $oldpath = '/images/blog/'.$blog->photo;
            if(file_exists($oldpath))
            {
                unlink($oldpath);
            }

            $blog['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $path = '/images/blog/'. $blog['photo'];
            Image::make($request->photo)->save($path);
        }
        $blog['heading'] = $request->heading;
        $blog['slug'] = str_replace(' ', '_', strtolower(htmlspecialchars($request->heading)));
        $blog['details'] = $request->details;
        $blog['tags'] = $request->tags;
        $blog['category_id'] = $request->category;
        $blog->update();

      return back()->with('success', 'Blog Post Updated Successfully!');
  }

  public function  blogDestroy($id)
  {
      $blog = Blog::findOrFail($id);
      $path = '/images/blog/'.$blog->photo;

      if(file_exists($path))
      {
        unlink($path);
      }
      $blog->delete();
      
      return back()->with('success', 'Blog Post Deleted Successfully!');
  }

  public function serviceHeading(Request $request)
  {
    $front = Frontend::first();
    $this->validate($request,[ 'heading' => 'required']);
    $front['service_heading'] = $request->heading;
    $front['service_details'] = $request->details;
    $front->update();

    return back()->with('success', 'Heading Updated Successfully');
  }
  public function testimHeading(Request $request)
  {
    $front = Frontend::first();
    $this->validate($request,[ 'heading' => 'required']);
    $front['testimonial_heading'] = $request->heading;
    $front['testim_details'] = $request->details;
    $front->update();

    return back()->with('success', 'Heading Updated Successfully');
  }
  public function faqHeading(Request $request)
  {
    $front = Frontend::first();
    $this->validate($request,[ 'heading' => 'required']);
    $front['faq_heading'] = $request->heading;
    $front['faq_details'] = $request->details;
    $front->update();

    return back()->with('success', 'Heading Updated Successfully');
  }

  public function statHeading(Request $request)
  {
    $front = Frontend::first();
    $this->validate($request,[ 'heading' => 'required','stat1'=> 'required','stat2'=> 'required','stat3'=> 'required',
    'stat4'=> 'required','stat5'=> 'required','stat6'=> 'required','stat7'=> 'required','stat8'=> 'required','stat9'=> 'required']);
    $front['stat_heading'] = $request->heading;
    $front['stat_details'] = $request->details;
    $front['stat1'] = $request->stat1;
    $front['stat2'] = $request->stat2;
    $front['stat3'] = $request->stat3;
    $front['stat4'] = $request->stat4;
    $front['stat5'] = $request->stat5;
    $front['stat6'] = $request->stat6;
    $front['stat7'] = $request->stat7;
    $front['stat8'] = $request->stat8;
    $front['stat9'] = $request->stat9;
    $front->update();

    return back()->with('success', 'Section Updated Successfully');
  }
  public function statSection()
  {
    $front = Frontend::first();
    $pt= "Statistics Section";
    return view('admin.website.stat', compact('pt','front'));
  }




  public function featureSection()
  {
      $features = Feature::all();
      $pt= "Features SECTION";
      $front = Frontend::first();
      return view('admin.website.features', compact('features','pt','front'));
  }

  public function featureHeading(Request $request)
  {
    $front = Frontend::first();
    $this->validate($request,[ 'heading' => 'required']);
    $front['feature_heading'] = $request->heading;
    $front['feature_details'] = $request->details;
    $front->update();

    return back()->with('success', 'Features Section Heading Updated Successfully');
  }


  public function featureStore(Request $request)
  {
      $this->validate($request,
          [
              'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
              'name' => 'required',
              'heading' => 'required',
              'details' => 'required',
          ]);

        if($request->hasFile('photo'))
        {
            $feature['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $path = '/images/slider/'. $feature['photo'];
            Image::make($request->photo)->save($path);
        }
      $feature['name'] = $request->name;
      $feature['heading'] = $request->heading;
      $feature['details'] = $request->details;
      Feature::create($feature);

      return back()->with('success', 'New Feaure Created Successfully!');
  }

 public function featureUpdate(Request $request, $id)
  {
      $feature = Feature::find($id);
      $this->validate($request,['photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048','name' => 'required','heading' => 'required','details' => 'required', ]);

        if($request->hasFile('photo'))
        {
            $oldpath = '/images/slider/'.$feature->photo;
            if(file_exists($oldpath))
            {
                unlink($oldpath);
            }

            $feature['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $path = '/images/slider/'. $feature['photo'];
            Image::make($request->photo)->save($path);
        }
        $feature['name'] = $request->name;
        $feature['heading'] = $request->heading;
        $feature['details'] = $request->details;
        $feature->update();

      return back()->with('success', 'Feature Updated Successfully!');
  }

  public function  featureDestroy($id)
  {
      $feature = Feature::findOrFail($id);
      $path = '/images/slider/'.$feature->photo;

      if(file_exists($path))
      {
          unlink($path);
      }
      $feature->delete();
      
      return back()->with('success', 'Feature Deleted Successfully!');
  }

}
