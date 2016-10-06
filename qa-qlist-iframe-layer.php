<?php

class qa_html_theme_layer extends qa_html_theme_base
{


	public function body()
	{
		if ($this->template === 'iframe') {
			unset($this->content['navigation']);
			unset($this->content['sidebar']);
			unset($this->content['sidepanel']);
			unset($this->content['widgets']);
			unset($this->content['logo']);
			unset($this->content['search']);
		}
		qa_html_theme_base::body();
	}

	public function body_header()
	{
		if ($this->template === 'iframe') {
			return;
		}
		qa_html_theme_base::body_header();
	}

	public function body_footer()
	{
		if ($this->template === 'iframe') {
			return;
		}
		qa_html_theme_base::body_footer();
	}

	public function body_hidden()
	{
		if ($this->template === 'iframe') {
			return;
		}
		qa_html_theme_base::body_hidden();
	}

	public function header()
	{
		if ($this->template === 'iframe') {
			return;
		}
		qa_html_theme_base::header();
	}

	public function footer()
	{
		if ($this->template === 'iframe') {
			return;
		}
		qa_html_theme_base::footer();
	}

	public function body_suffix()
	{
		if ($this->template === 'iframe') {
			return;
		}
		qa_html_theme_base::body_suffix();
	}

	public function sidepanel()
	{
		if ($this->template === 'iframe') {
			return;
		}
		qa_html_theme_base::sidepanel();
	}

	public function widgets($region, $place)
	{
		if ($this->template === 'iframe') {
			return;
		}
		qa_html_theme_base::widgets($region, $place);
	}


	public function body_tags()
	{
		if ($this->template === 'iframe') {
			$this->output(' style="background:white;" ');
		}
		qa_html_theme_base::body_tags();
	}

	public function head_script()
	{
		if ($this->template === 'iframe') {
			if (isset($this->content['script'])) {
				foreach ($this->content['script'] as $scriptline)
					$this->output_raw($scriptline);
			}
			return;
		}
		qa_html_theme_base::head_script();
	}

	public function body_script()
	{
		qa_html_theme_base::body_script();
		if ($this->template === 'iframe') {
			$script = <<<EOS
<script>
$(document).ready(function(){
	$('a').attr('target', '_blank');
});
</script>
EOS;
			$this->output($script);
		}
	}

}
