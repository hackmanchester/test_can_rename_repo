require "csv"

actors={}
CSV.foreach("../data/actor.tsv",{:col_sep=>"\t", :headers=>true, :return_headers => true, :header_converters => :symbol, :converters => :all}) do |row|
	actor = Hash[row.headers[1..-1].zip(row.fields[1..-1])]
	if actor[:film]!=nil then
		actor[:film]=actor[:film].split(',')
		puts actor
		actors[row.fields[0]] = actor
	end
end
